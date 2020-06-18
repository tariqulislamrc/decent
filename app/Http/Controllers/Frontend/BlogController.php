<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\BlogCategory;
use App\models\eCommerce\BlogPost;
use App\models\eCommerce\PageBanner;

class BlogController extends Controller
{
    public function index()
    {
        $banner = PageBanner::where('page_name', 'blog')->first();
        $posts = BlogPost::where('status','Active')->orderBy('id', 'desc')->paginate(5);
        // dd($posts);
        return view('eCommerce.blog',compact('posts', 'banner'));
        
    }


    public function post_details($id)
    {
        $model = BlogPost::where('post_slug', $id)->first();
        return view('eCommerce.blog-details', compact('model'));
        
    }
    public function category_details($id)
    {
        $banner = PageBanner::where('page_name', 'blog')->first();
        $cate = BlogCategory::where('category_slug', $id)->first();
        $posts = BlogPost::where('status', 'Active')->where('blog_category_id',$cate->id)->orderBy('id', 'desc')->paginate(5);
        // dd($posts);
        return view('eCommerce.blog', compact('posts', 'banner'));
        
    }
}
