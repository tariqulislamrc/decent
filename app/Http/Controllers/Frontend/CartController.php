<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Production\Product;
use Cart;

class CartController extends Controller
{
    public function add_cart(Request $request)
    {
         $a= Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->qty
        ));
        $cart_total =  Cart::getTotal();

        return response()->json(['success' => true, 'cart_total' => $cart_total, 'status' => 'success', 'message' => _lang('Product Added To Cart Successfuly')]);

    }

    public function show_cart()
    {
        $models = Cart::getContent();
        return view('eCommerce.shopping-cart', compact('models'));

    }

    public function qty_cart(Request $request)
    {
        Cart::update($request->id, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->qty
            ),
        ));


        $models = Cart::getContent();
        return view('eCommerce.update-qty', compact('models'));

    }
    public function remove_cart(Request $request)
    {
        Cart::remove($request->id);

        $models = Cart::getContent();
        return view('eCommerce.update-qty', compact('models'));

    }
}
