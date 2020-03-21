<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\Coupon;
use App\models\Production\Product;
use App\models\Production\VariationBrandDetails;
use Cart;
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
        $models = Cart::getContent();
        Session::put('total', $request->total_hidden);
        Session::put('coupon', $request->coupon_amt);

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Welcome To Checkout Page'), 'goto' => route('shopping-checkout')]);
    }

    public function checkout(Request $request)
    {
        $models = Cart::getContent();
        return view('eCommerce.checkout', compact('models'));
    }

    public function store_checkout(Request $request)
    {
        
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);
    }
}
