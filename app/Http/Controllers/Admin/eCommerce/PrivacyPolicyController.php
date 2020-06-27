<?php

namespace App\Http\Controllers\admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\PrivacyPolicy;
use App\WholeSale;

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

    // whole_sale_index
    public function whole_sale_index() {
        $model = WholeSale::first();
        return view('admin.eCommerce.whole_sale.index', compact('model'));
    }

    // whole_sale_store
    public function whole_sale_store(Request $request) {
        $data = $request->validate([
            'header' => 'required',
            'description' => 'required',
        ]);
        
         if($request->row_id){
            $nodels = WholeSale::findOrFail($request->row_id);
            if($request->hasFile('catelog')) {
                $storagepath = $request->file('catelog')->store('public/catelog');
                $fileName = basename($storagepath);
                
                $nodels->catelog = $fileName;
    
            }
            $nodels->update($data);
             return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated'), 'goto' => route('admin.eCommerce.whole-sale')]);
         }else{
            $model = new WholeSale;
            $model->header = $request->header;
            $model->description = $request->description;
            if($request->hasFile('catelog')) {
                $storagepath = $request->file('catelog')->store('public/catelog');
                $fileName = basename($storagepath);
                
                $model->catelog = $fileName;
            }
            $model->save();
             return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'goto' => route('admin.eCommerce.whole-sale')]);
         }
    }
}
