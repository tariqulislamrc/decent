<?php

namespace App\Http\Controllers\admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\ShippingCharge;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;
use Auth;

class ShippingChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.eCommerce.shipping_charge.index');
    }


    public function datatable(Request $request){
       if ($request->ajax()) {
            $document = ShippingCharge::where('shipping_area', '!=', config('system.default_role.admin'))->get();
            return DataTables::of($document)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return view('admin.eCommerce.shipping_charge.action', compact('model'));
                })
                ->rawColumns(['action'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.eCommerce.shipping_charge.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data = $request->validate([
            'shipping_area' => 'required|unique:shipping_charges|max:255',
            'shipping_charge' => 'required',
            'note' => '',
        ]);
        $data['created_by']=Auth::user()->id;
        $model = new ShippingCharge;
        $model->create($data);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Shipping Charges Create Successfuly'), 'goto' => route('admin.eCommerce.shipping-charge.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $model = ShippingCharge::findOrFail($id);
        return view('admin.eCommerce.shipping_charge.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $model = ShippingCharge::findOrFail($id);
        $data = $request->validate([
            'shipping_area' => ['required',Rule::unique('shipping_charges')->ignore($model->id)],
            'shipping_charge' => 'required',
            'note' => '',
        ]);
        $data['updated_by']=Auth::user()->id;
        $model->update($data);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Shipping Charges Update Successfuly'), 'goto' => route('admin.eCommerce.shipping-charge.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $model = ShippingCharge::findOrFail($id);
        $model->delete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Shipping Charges Deleted Successfuly'), 'goto' => route('admin.eCommerce.shipping-charge.index')]);
    }
}
