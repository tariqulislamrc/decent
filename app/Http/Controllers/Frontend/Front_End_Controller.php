<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\PrivacyPolicy;
use App\models\eCommerce\AboutUs;
use App\models\eCommerce\TeramsCondition;
use App\models\Production\Category;
use App\models\Production\Product;
use App\models\eCommerce\OurTeam;
use App\models\eCommerce\OurWorkspace;
use App\models\eCommerce\ContactUs;
use App\models\Production\Variation;
use App\models\Production\VariationBrandDetails;

class Front_End_Controller extends Controller{
    
    public function privacyPolicy(){
        $model = PrivacyPolicy::first();
        return view('eCommerce.privacy_policy',compact('model'));
    }

    public function aboutUs(){
        $model = AboutUs::first();
        $our_team = OurTeam::all();
        $our_workspace = OurWorkspace::all();
        return view('eCommerce.about',compact('model','our_team','our_workspace'));
    }

    public function termsCondition(){
        $model = TeramsCondition::first();
        return view('eCommerce.terms_conditions',compact('model'));
    }

    public function contactUs(){
        return view('eCommerce.contact');
    }

    public function contact(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'descsription' => 'required',
        ]);
        $data['msg_status'] = 1;
        $model = new ContactUs;
        $model->create($data);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Message Seed Successfuly'), 'goto' => route('contact')]);
    }

    public function product(){
        $product_id = [];
        $brand_id = get_option('default_brand');
        $product = VariationBrandDetails::where('brand_id', $brand_id)->get();
        foreach ($product as $value) {
            $product_id[] = $value->product_id;
        }
        $products = Product::whereIn('id', $product_id)->get();
        $category = Category::with('product')->get();
        return view('eCommerce.product_grid_view', compact('category', 'products'));
    }

    public function product_details($id){
        $model = Product::with('photo_details', 'variation')->findOrFail($id);
        return view('eCommerce.product_details', compact('model'));
    }
    public function get_price(Request $request){
        $price = Variation::findOrFail($request->id);
        $qty = VariationBrandDetails::where('variation_id', $request->id)->first();
        return response()->json(['price' => $price, 'qty' => $qty]);
    }

}
