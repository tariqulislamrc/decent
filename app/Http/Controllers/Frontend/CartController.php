<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\Coupon;
use App\models\Production\Product;
use App\models\Client;
use App\models\inventory\TransactionSellLine;
use App\models\Production\Transaction;
use App\models\Production\VariationBrandDetails;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use View;
use Session;

class CartController extends Controller
{
    public function add_cart(Request $request)
    {

        $request->validate([
            'variation' => 'required',
            'qty' => 'required'
        ]);
        
        $qty_available = 0;
        $qty = VariationBrandDetails::where('variation_id', $request->variation)->first();
        if ($qty) {
            $qty_available = $qty->qty_available;
        }
        if ($request->qty > $qty_available) {
            return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang('Quantity Not Available')]);
        }
        
         $a= Cart::add(array(
            'id' => $request->variation,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->qty,
            'attributes' => array(
                'product_id' => $request->id
            ),
        ));
        $cart_total =  Cart::getTotal();
        $bdt = get_option('currency');

        return response()->json(['success' => true, 'cart_total' => $cart_total , 'bdt'=>$bdt, 'status' => 'success', 'message' => _lang('Product Added To Cart Successfuly')]);

    }

    public function show_cart()
    {
        $cart_total =  Cart::getContent();
        
        if (count($cart_total) > 0) {
            Session::put('coupon', null);
            $models = Cart::getContent();
            return view('eCommerce.shopping-cart', compact('models'));
        }else{
            return redirect()->back()->with('error', 'The Cart is Empty.');  
        }
        

    }

    public function qty_cart(Request $request)
    {
        Cart::update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->qty
            ),
        ));

        $total = Cart::getTotal();
        $sub_total = Cart::getSubTotal();

        $bdt = get_option('currency');
        $models = Cart::getContent();

        return response()->json(['view'=>View::make('eCommerce.update-qty', compact('models'))->render(),'total'=> $total, 'bdt' => $bdt, 'sub_total'=> $sub_total]);

    }
    public function remove_cart(Request $request)
    {
        Cart::remove($request->id);
        $models = Cart::getContent();
        $total = Cart::getTotal();
        $sub_total = Cart::getSubTotal();
        $bdt = get_option('currency');

        return response()->json(['view' => View::make('eCommerce.update-qty', compact('models'))->render(), 'total' => $total, 'bdt' => $bdt, 'sub_total' => $sub_total]);

    }

    public function coupon_check(Request $request)
    {
        
        if ($request->coupon == null) {
            return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang('The coupon field is required.')]);
        }

        $model = Coupon::where('coupons_code', $request->coupon)->first();
        if($model){

            if (Session::get('coupon')) {
                return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang('Coupon Already Used.')]);
            }
            
            Session::put('coupon', $model);
            return response()->json(['success' => true, 'coupon' => $model, 'status' => 'success', 'message' => _lang('Coupon Code Match Successfuly')]);

        }else{
            return response()->json(['success' => true, 'status' => 'error', 'message' => _lang('Coupon Code Doesnot Match')]);
        }

    }


    public function store_cart(Request $request)
    {
        if (auth('client')->check() == true) {
            $models = Cart::getContent();
            Session::put('total', $request->total_hidden);
            Session::put('coupon', $request->coupon_amt);

            return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Welcome To Checkout Page'), 'goto' => route('shopping-checkout')]);
        } else {
            return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang('Please Login First'), 'goto' => route('account')]);
        }
    }

    public function checkout(Request $request)
    {
        if (auth('client')->check() == true) {
            $user = auth('client')->user('clients_id');
            $client = Client::findOrFail($user->clients_id);
            $models = Cart::getContent();
            return view('eCommerce.checkout', compact('models', 'client'));
        } else {
            return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang('Please Login First'), 'goto' => route('account')]);
        }
    }

    public function store_checkout(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'email' => 'required',
            'mobile' => 'required'
        ]);

        $client = Client::findOrFail($request->client_id);
        $client->name = $request->name;
        $client->last_name = $request->last_name;
        $client->company_name = $request->company_name;
        $client->address = $request->address;
        $client->city = $request->city;
        $client->state = $request->state;
        $client->post_code = $request->post_code;
        $client->email = $request->email;
        $client->mobile = $request->mobile;
        $client->save();


        $code_prefix = get_option('invoice_code_prefix');
        $code_digits = get_option('digits_invoice_code');
        $uniqu_id = generate_id('purchase', false);
        $uniqu_id = numer_padding($uniqu_id, $code_digits);
        $invoice_no = $code_prefix . $uniqu_id;

        $payment = new Transaction();
        $payment->invoice_no = $invoice_no;
        $payment->sub_total = $request->sub_total;
        $payment->net_total = $request->total;
        $payment->order_notes = $request->order_note;
        $payment->payment_status = 'cash_on_delivery';

        if($request->checkbox == 'on'){
            $payment->shipping_status = 'On';
            $payment->full_name = $request->forname;
            $payment->email = $request->foremail;
            $payment->phone = $request->forphone;
            $payment->address = $request->foraddress;
            $payment->city = $request->forcity;
        }
        $payment->save();
        $transaction_id = $payment->id;


        for ($i = 0; $i < count($request->product_id); $i++) {

            $transaction = new TransactionSellLine();
            $transaction->transaction_id = $transaction_id;
            $transaction->client_id = $request->client_id;
            $transaction->product_id = $request->product_id[$i];
            $transaction->variation_id = $request->variation_id[$i];
            $transaction->quantity = $request->quantity[$i];
            $transaction->unit_price  = $request->price[$i];
            $total = ($request->quantity[$i]) * ($request->price[$i]);
            $transaction->total = $total;
            $transaction->save();
        }

        generate_id('purchase', true);

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Order Complete Successfuly')]);

    }
}
