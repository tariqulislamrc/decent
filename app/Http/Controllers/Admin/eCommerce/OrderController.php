<?php

namespace App\Http\Controllers\Admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Client;
use App\Utilities\TransactionUtil;
use App\models\eCommerce\ClientShippingAddress;
use App\models\eCommerce\Coupon;
use App\models\eCommerce\OrderStatus;
use App\models\inventory\TransactionSellLine;
use App\models\Production\Product;
use App\models\Production\Transaction;
use App\models\Production\TransactionPayment;
use App\models\Production\VariationBrandDetails;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    
    protected $transactionUtil;
    public function __construct(TransactionUtil $transactionUtil)
    {
        $this->transactionUtil = $transactionUtil;
    }

    // eCommerce Order List index page
    public function index() {
        $models = Transaction::where('ecommerce_status', 'pending')->orderBy('id', 'desc')->get();
        return view('admin.eCommerce.order.index', compact('models'));
    }

    // show 
    public function show ($id) {
        $model = Transaction::findOrFail($id);

        $products = TransactionSellLine::where('transaction_id', $model->id)->get();
        return view('admin.eCommerce.order.show', compact('model', 'products'));
    }

    // change_status
    public function change_status(Request $request) {
        $id = $request->id;
        $val = $request->val;
        $note = $request->note;
        $model = Transaction::where('id', $id)->first();
        $model->sell_note = $note;
        $status = $model->ecommerce_status;
        if($status == 'cancel') {
            if($val == 'progressing' || $val == 'shipment' || $val == 'success' || $val == 'cancel') {
                return response()->json(['success' => true, 'html' => 'cancel', 'status' => 'danger', 'message' => _lang('First Make the Order Pending Or Confirm')]);
            }
        }

        if ($val == 'pending') {
            $data = 'Pending';
        } elseif ($val == 'confirm') {
            
            // find all products from transaction sell line table
            $fapftslt = TransactionSellLine::where('transaction_id', $id)->get();
            foreach($fapftslt as $item) {
                $product_id = $item->product_id;
                $variation_id = $item->variation_id;
                $upgrade_qty = $item->quantity;
                
                // make the quantity low in main available taable
                $table = VariationBrandDetails::where('product_id', $product_id)->where('variation_id', $variation_id)->first();
                $old_qty = $table->qty_available;
                $new_qty = round($old_qty) - round($upgrade_qty);
                $table->qty_available = $new_qty;
                $table->save();
            }
            $data = 'Confirm';
        } elseif ($val == 'progressing') {
            $data = 'In Progressing';
        } elseif ($val == 'shipment') {
            $data = 'In Shipment';
        } elseif ($val == 'success') {
            $data = 'Success';
                $transaction_payment = new TransactionPayment();
                $transaction_payment->transaction_id = $model->id;
                $transaction_payment->method = $model->payment_status;
                $transaction_payment->payment_date = $model->date;
                $transaction_payment->amount = $model->net_total;
                $transaction_payment->type = 'credit';
                $transaction_payment->save();
        } else {
            // find all products from transaction sell line table
            $fapftslt = TransactionSellLine::where('transaction_id', $id)->get();
            foreach($fapftslt as $item) {
                $product_id = $item->product_id;
                $variation_id = $item->variation_id;
                $upgrade_qty = $item->quantity;
                
                // make the quantity low in main available taable
                $table = VariationBrandDetails::where('product_id', $product_id)->where('variation_id', $variation_id)->first();
                $old_qty = $table->qty_available;
                $new_qty = round($old_qty) + round($upgrade_qty);
                $table->qty_available = $new_qty;
                $table->save();
            }
            $data = 'Cancel';
        }

        if($model) {
            $model->ecommerce_status = $val;
            $model->save();

            // Activity Log
            activity()->log('Change Order Status - ' . $model->reference_no);
            return response()->json(['success' => true, 'html' => $data, 'status' => 'success', 'message' => _lang('Order Status Change Successfully')]);

        } else {
            return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang('Order Not Found')]);
        }
    }

    // sort_order
    public function sort_order(Request $request) {
        $val = $request->val;
        $models = Transaction::where('ecommerce_status', $val)->orderBy('id', 'desc')->get();
        return view('admin.eCommerce.order.data', compact('models'));
    }

    // sort_order_date_wise
    public function sort_order_date_wise(Request $request) {
        $val = $request->val;
        $date = $request->start;
        $ex = explode('to', $date);
        $start = $ex[0];
        $end = trim($ex[1]);
        
        $models = Transaction::where('ecommerce_status', $val)->whereBetween('created_at', [$start, $end])->orderBy('id', 'desc')->get();
        return view('admin.eCommerce.order.data', compact('models'));
    }

    // pdf
    public function pdf($id) {
        $model = Transaction::where('reference_no', $id)->firstOrFail();
        return view('admin.eCommerce.order.pdf', compact('model'));
    }

    // show_update_page
    public function show_update_page($id) {
        $model = Transaction::findOrFail($id);

        $sell_products = TransactionSellLine::where('transaction_id', $model->id)->get();

        $product_id = [];
        $brand_id = get_option('default_brand');
        // dd($brand_id);
        $product = VariationBrandDetails::where('brand_id', $brand_id)->get();

        foreach ($product as $value) {
            $product_id[] = $value->product_id;
        }

        $products = Product::whereIn('id', $product_id)->orderBy('avarage_retting', 'DESC')->take(3)->get();

        // find the coupon
        $coupon_id = $model->tek_marks;
        if($coupon_id != '') {

            $coupon = Coupon::where('id', $coupon_id)->first();
            if($coupon) {
                $coupon_amount = $coupon->discount_amount;
                $coupon_type = $coupon->discount_type;
            } else {
                $coupon_amount = 0;
                $coupon_type = 'None';
            }

        } else {
            $coupon_amount = 0;
            $coupon_type = 'None';
        }

        return view('admin.eCommerce.order.update', compact('model', 'sell_products', 'products', 'coupon_amount', 'coupon_type'));

    }

    // edit_the_transaction
    public function edit_the_transaction(Request $request, $id) {
        // dd($request->all());

        // find the Transaction Row
        $model = Transaction::findOrFail($id);

        // if status is payment done then no option for change status
        if($model->ecommerce_status == 'payment_done'  && $request->status != 'return') {
            return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang('Sorry. You Can only change status to RETURN on Payment Done Status')]);
        }

        // if status is confirm then no option for status pending
        if($model->ecommerce_status != 'pending'  && $request->status != 'pending') {
            return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang('Sorry. You can not go back to Pending Status')]);
        }

        // is the status is calcel 
        if($request->status == 'cancel') {
            if($model->ecommerce_status == 'progressing' || $model->ecommerce_status == 'shipment' || $model->ecommerce_status == 'success' || $model->ecommerce_status == 'payment_done') {
                return response()->json(['success' => true, 'html' => 'cancel', 'status' => 'danger', 'message' => _lang('First Make the Order Pending Or Confirm')]);
            }
        }

        // change the shiping address
        if($request->shipping_status == 'On') {
            $model->full_name = $request->ship_another_full_name;
            $model->email = $request->ship_another_email;
            $model->phone = $request->ship_another_phone;
            $model->address = $request->ship_another_address;
            $model->city = $request->ship_another_city;
        }

        // find the client
        $client = Client::findOrFail($model->client_id);

        // find the transaction sell line 
        $transaction_sell_lines = TransactionSellLine::where('transaction_id', $id)->get();

        // delete all transaction sell line for this transaction row
        if($transaction_sell_lines) {
            foreach($transaction_sell_lines as $sell_line) {
                $sell_line->delete();
            }
        }

        // add new transaction sell line for this transaction 
        for ($i = 0; $i < count($request->product_id); $i++) {

            $transaction = new TransactionSellLine();
            $transaction->transaction_id = $id;
            $transaction->client_id = $client->id;
            $transaction->product_id = $request->product_id[$i];
            $transaction->variation_id = $request->variation_id[$i];
            $transaction->quantity = $request->quantity[$i];
            $transaction->unit_price  = $request->price[$i];
            $total = ($request->quantity[$i]) * ($request->price[$i]);
            $transaction->total = $total;
            $transaction->save();

            $this->transactionUtil->decreaseProductQuantity(
                $request->product_id[$i],
                $request->variation_id[$i],
                get_option('default_brand'),
                $request->quantity[$i]
            );
        }
        // update transaction table
        if($request->status == 'success') {
            $model->payment_status = 'Paid';
            $model->paid = $request->net_total;
            $model->due = 0;
        }
        $model->sub_total = $request->subtotal;
        $model->discount_amount = $request->subtotal - $request->net_total;
        $model->net_total = $request->net_total;


        // update ecommerce status
        $model->ecommerce_status = $request->status;
        $model->save();

        if($request->status == 'success') {
            $transaction_payment = new TransactionPayment();
            $transaction_payment->transaction_id = $id;
            $transaction_payment->method = 'Cash On Delivery';
            $transaction_payment->payment_date = date('Y-m-d');
            $transaction_payment->amount = $request->net_total;
            $transaction_payment->type = 'credit';
            $transaction_payment->save();
        }

        $status = new OrderStatus;
        $status->transaction_id = $id;
        $status->user_id = Auth::user()->id;
        $status->status = $request->status;
        $status->note = $request->order_note;
        $status->save();


        // return
        return response()->json(['success' => true,  'status' => 'success', 'message' => _lang('Order Status Change Successfully')]);

    }
}
