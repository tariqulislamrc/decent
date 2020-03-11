<?php

namespace App\Http\Controllers\Admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\AboutUs;

class AboutUsController extends Controller{
    public function index(){
        $model = AboutUs::first();
        return view('admin.eCommerce.about.index',compact('model'));
    }

     public function store(Request $request){
       //dd($request->all());
       $data = $request->validate([
            'name' => 'required',
            'header_image' => '',
            'description' => 'required',
        ]);

         if($request->row_id){
            $nodels = AboutUs::findOrFail($request->row_id);
             if ($request->hasFile('header_image')) {
                $storagepath = $request->file('header_image')->store('public/eCommerce/about');
                $fileName = basename($storagepath);
                $data['header_image'] = $fileName;
            }else{
                $data['header_image'] = $nodels->header_image;
            }
            $nodels->update($data);
            return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated'), 'goto' => route('admin.eCommerce.about-us.index')]);
         }else{
             if ($request->hasFile('header_image')) {
                $storagepath = $request->file('header_image')->store('public/eCommerce/about');
                $fileName = basename($storagepath);
                $data['header_image'] = $fileName;
            }else{
                $data['header_image'] = '';
            }
            $model = new AboutUs;
            $model->create($data);
             return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'goto' => route('admin.eCommerce.about-us.index')]);
         }
    }
}
