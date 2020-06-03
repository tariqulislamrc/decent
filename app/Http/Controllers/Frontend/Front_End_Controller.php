<?php

namespace App\Http\Controllers\Frontend;

use App\EcommerceOffer;
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
use App\models\eCommerce\PageBanner;
use App\models\eCommerce\ProductRating;
use App\models\eCommerce\Wishlist;
use App\models\Production\Variation;
use App\models\Production\Transaction;
use App\models\inventory\TransactionSellLine;
use App\models\Production\VariationBrandDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Front_End_Controller extends Controller{
    
    public function index(){

        $product_id = [];
        $brand_id = get_option('default_brand');
        // dd($brand_id);
        $product = VariationBrandDetails::where('brand_id', $brand_id)->get();

        foreach ($product as $value) {
            $product_id[] = $value->product_id;
        }

        $products = Product::whereIn('id', $product_id)->orderBy('avarage_retting', 'DESC')->take(3)->get();

        $general_products = Product::OrderBy('id', 'desc')->take(4)->get();

        $seo  = Seo::first();
        $slider = Slider::all();

        $banner_image_one = HomePage::where('banner_image_one_check',1)->orderBy('id','desc')->first();
        $banner_image_two = HomePage::where('banner_image_two_check',1)->orderBy('id','desc')->first();
        $banner_fream     = HomePage::orderBy('id','desc')->take(3)->get();
        $banner_fream_two = HomePage::orderBy('id','desc')->take(2)->get();
        $featur_product   = Product::where('feature_product_status','1')->orderBy('id','desc')->take(20)->get();
        $footer_featur_product   = Product::where('feature_product_status','1')->orderBy('id','desc')->take(4)->get();
        $hot_sale   = Product::where('hot_sale_status','1')->orderBy('id','desc')->take(4)->get();
        $latest_product   = Product::orderBy('id','desc')->take(4)->get();
        return view('eCommerce.index',compact('general_products', 'seo','slider','banner_image_one','banner_image_two','banner_fream', 'products','banner_fream_two','featur_product','latest_product','hot_sale','footer_featur_product'));
    }
    
    public function privacyPolicy(){
        $model = PrivacyPolicy::first();
        $banner = PageBanner::where('page_name','Contact')->first();
        return view('eCommerce.privacy_policy',compact('model', 'banner'));
    }

    public function category_product($id){
        $banner = PageBanner::where('page_name', 'Category')->first();
        $products = Product::where('category_id', $id)->paginate(15);
        $category = Category::with('product')->get();
        return view('eCommerce.product_grid_view', compact('category', 'products','banner'));
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
        $banner = PageBanner::where('page_name','Contact')->first();
        return view('eCommerce.terms_conditions',compact('model', 'banner'));
    }

    public function contactUs(){
        $banner = PageBanner::where('page_name','Contact')->first();
        return view('eCommerce.contact', compact('banner'));
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
        $banner = PageBanner::where('page_name', 'Product')->first();
        $product_id = [];
        $brand_id = get_option('default_brand');
        $product = VariationBrandDetails::where('brand_id', $brand_id)->get();
        foreach ($product as $value) {
            $product_id[] = $value->product_id;
        }
        $products = Product::whereIn('id', $product_id)->paginate(15);
        $category = Category::with('product')->get();
        return view('eCommerce.product_grid_view', compact('category', 'products','banner'));
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

    public function offer_details($uuid){
        // offer
        $model = EcommerceOffer::where('uuid',$uuid)->firstOrFail();
        // product
        $product = Product::with('photo_details', 'variation')->where('id',$model->product_id)->first();
        $product_rating = ProductRating::where('product_id',$model->product_id)->get();
        $avarage = $product_rating->sum('rating');
        $total_row = $product_rating->count();
        if ($total_row>0) {
            $avarage_rating = ($avarage / $total_row);
        }else{
            $avarage_rating = 0;
        }
        // dd($product);
        return view('eCommerce.offer_details', compact('model', 'product','product_rating','avarage_rating','total_row'));
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

    // add_into_wishlist
    public function add_into_wishlist(Request $request) {
        $find = Wishlist::where('ip', $request->ip)->where('product_id', $request->id)->first();
        if($find) {
            return response()->json(['success' => true, 'status' => 'warning', 'message' => _lang('Product Already added into your wishlist')]);
        } else {
            $model = new Wishlist;
            $model->ip = $request->ip;
            $model->product_id = $request->id;
            $model->save();
            return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Product added into your wishlist')]);
        }
    }

    // wishlist
    public function wishlist() {
        $banner = PageBanner::where('page_name', 'Wishlist')->first();
        $ip = getIp();
        $product_id = [];

        $wishlists = Wishlist::where('ip', $ip)->get();
        foreach($wishlists as $wishlist) {
            $product_id[] = $wishlist->product_id;
        }

        $products = Product::whereIn('id', $product_id)->orderBy('avarage_retting', 'DESC')->get();

        return view('eCommerce.wishlist', compact('products','banner'));
    }

    // delete_into_wishlist
    public function delete_into_wishlist(Request $request) {
        $find = Wishlist::where('ip', $request->ip)->where('product_id', $request->id)->first();
        if($find) {
            $find->delete();
        }

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Product Removed from your wishlist') , 'load' => true]);
    }

    public function invoice($id) {
        $transaction =  Transaction::where('reference_no',$id)->first();
        $transaction_sale = TransactionSellLine::where('transaction_id',$transaction->id)->get();
        return view('eCommerce.invoice',compact('transaction','transaction_sale'));
    }
}
