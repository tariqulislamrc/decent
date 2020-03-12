<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\PrivacyPolicy;
use App\models\eCommerce\AboutUs;
use App\models\Production\Category;
use App\models\Production\Product;

class Front_End_Controller extends Controller{
    
    public function privacyPolicy(){
        $model = PrivacyPolicy::first();
        return view('eCommerce.privacy_policy',compact('model'));
    }

    public function aboutUs(){
        $model = AboutUs::first();
        return view('eCommerce.about',compact('model'));
    }

    public function product(){
        $brand_id = get_option('default_brand');
        $products = Product::get();
        $category = Category::with('product')->get();
        return view('eCommerce.product_grid_view', compact('category', 'products'));
    }

}
