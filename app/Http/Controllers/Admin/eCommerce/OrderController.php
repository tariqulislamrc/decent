<?php

namespace App\Http\Controllers\Admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\ClientShippingAddress;
use App\models\inventory\TransactionSellLine;
use App\models\Production\Transaction;
use App\models\Production\TransactionPayment;
use App\models\Production\VariationBrandDetails;

class OrderController extends Controller
{
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
        $model = Transaction::where('id', $id)->first();

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
                $transaction_payment->client_id = $model->client_id;
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

    // change_ship_address
    public function change_ship_address(Request $request) {
        $request->validate([
            'id'        =>  'required',
            'client_name'        =>  'required',
            'client_phone'        =>  'required',
            'client_email'        =>  'required',
            'client_address'        =>  'required',
            'client_city'        =>  'required',
        ]);

        $item = ClientShippingAddress::where('transaction_id', $request->id)->first();
        if($item) {
            $item->client_name = $request->client_name;
            $item->client_phone = $request->client_phone;
            $item->client_email = $request->client_email;
            $item->client_address = $request->client_address;
            $item->client_city = $request->client_city;
            $item->note = $request->note;
            $item->save();
        } else {
            $model = new ClientShippingAddress;
            $model->transaction_id = $request->id;
            $model->client_name = $request->client_name;
            $model->client_phone = $request->client_phone;
            $model->client_email = $request->client_email;
            $model->client_address = $request->client_address;
            $model->client_city = $request->client_city;
            $model->note = $request->note;
            $model->save();
        }

        // Activity Log
        activity()->log('Change Sipping Address for transaction id - ' . $request->transaction_id);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated Successfully'), 'load' => true]);

    }
}
