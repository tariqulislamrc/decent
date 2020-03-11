<?php

namespace App\Http\Controllers\admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\PrivacyPolicy;

class PrivacyPolicyController extends Controller{
    public function index(){
       $model =  PrivacyPolicy::first();
        return view('admin.eCommerce.privacy_policy.index',compact('model'));
    }
    public function store(Request $request){
       //dd($request->all());
       $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
         if($request->row_id){
            $nodels = PrivacyPolicy::findOrFail($request->row_id);
            $nodels->update($data);
             return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated'), 'goto' => route('admin.eCommerce.privacy-policy.index')]);
         }else{
            $model = new PrivacyPolicy;
            $model->create($data);
             return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'goto' => route('admin.eCommerce.privacy-policy.index')]);
         }
    }
}
