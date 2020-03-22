<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\PrivacyPolicy;
use App\models\eCommerce\AboutUs;
use App\models\eCommerce\Seo;
use App\models\eCommerce\Slider;
use App\models\eCommerce\TeramsCondition;
use App\models\Production\Category;
use App\models\Production\Product;
use App\models\eCommerce\OurTeam;
use App\models\eCommerce\OurWorkspace;
use App\models\eCommerce\ContactUs;
use App\models\eCommerce\HomePage;
use App\models\eCommerce\ProductRating;
use App\models\Production\Variation;
use App\models\Production\VariationBrandDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Front_End_Controller extends Controller{
    
    public function index(){

        $product_id = [];
        $brand_id = get_option('default_brand');
        $product = VariationBrandDetails::where('brand_id', $brand_id)->get();
        foreach ($product as $value) {
            $product_id[] = $value->product_id;
        }
        $products = Product::whereIn('id', $product_id)->orderBy('avarage_retting', 'DESC')->take(3)->get();
        $seo  = Seo::first();
        $slider = Slider::all();
        $banner_image_one = HomePage::where('banner_image_one_check',1)->orderBy('id','desc')->first();
        $banner_image_two = HomePage::where('banner_image_two_check',1)->orderBy('id','desc')->first();
        $banner_fream = HomePage::orderBy('id','desc')->take(3)->get();
        return view('eCommerce.index',compact('seo','slider','banner_image_one','banner_image_two','banner_fream', 'products'));
    }
    
    public function privacyPolicy(){
        $model = PrivacyPolicy::first();
        return view('eCommerce.privacy_policy',compact('model'));
    }

    public function category_product($id){
        $products = Product::where('category_id', $id)->get();
        return view('eCommerce.category', compact('products'));
    }



    public function account()
    {
        if (Auth::check()) {
         return Redirect::to('home');
        } else {
            return view('eCommerce.account');
        }
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
        $product_rating = ProductRating::where('product_id',$id)->get();
        $avarage = $product_rating->sum('rating');
        $total_row = $product_rating->count();
        if ($total_row>0) {
            $avarage_rating = ($avarage / $total_row);
        }else{
            $avarage_rating = 0;
        }
        $model = Product::with('photo_details', 'variation')->findOrFail($id);
        return view('eCommerce.product_details', compact('model','product_rating','avarage_rating','total_row'));
    }

    
    public function get_price(Request $request){
        $price = Variation::findOrFail($request->id);
        $qty = VariationBrandDetails::where('variation_id', $request->id)->first();
        return response()->json(['price' => $price, 'qty' => $qty]);
    }

    public function productRating(Request $request){
         $request->validate([
            'product_id' => 'required',
            'user_id' => '',
            'score' => 'required',
            'name' => 'required',
            'email' => 'required',
            'comment' => 'required',
        ]);
        $model = new ProductRating;
        $model->product_id=$request->product_id;
        $model->rating=$request->score;
        $model->name=$request->name;
        $model->email=$request->email;
        $model->comment=$request->comment;
        $model->save();
        if ($request->product_id) {
            $retting_model = ProductRating::findOrFail($model->id);
            $product_model = Product::findOrFail($request->product_id);
            $avarage = $retting_model->avg('rating');
            $product_model->avarage_retting = $avarage;
            $product_model->save();
        }
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Thamks for product rating'), 'goto' => route('product-details', $request->product_id)]);
    }
}
