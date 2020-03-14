<?php

namespace App\Http\Controllers\admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\Coupon;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;
use Auth;

class CouponsController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.eCommerce.coupons.index');
    }


    public function datatable(Request $request){
       if ($request->ajax()) {
            $document = Coupon::where('coupons_code', '!=', config('system.default_role.admin'))->get();
            return DataTables::of($document)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return view('admin.eCommerce.coupons.action', compact('model'));
                })
                ->rawColumns(['action'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.eCommerce.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
       $data = $request->validate([
            'coupons_code' => 'required|unique:coupons|max:255',
            'discount_type' => 'required',
            'discount_amount' => 'required',
            'note' => '',
        ]);
        $data['created_by']=Auth::user()->id;
        $model = new Coupon;
        $model->create($data);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Coupons Create Successfuly'), 'goto' => route('admin.eCommerce.coupons.index')]);
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
    public function edit($id)
    {
        $model = Coupon::findOrFail($id);
        return view('admin.eCommerce.coupons.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $model = Coupon::findOrFail($id);
        $data = $request->validate([
            'coupons_code' => ['required',Rule::unique('coupons')->ignore($model->id)],
            'discount_type' => 'required',
            'discount_amount' => 'required',
            'note' => '',
        ]);
        $data['updated_by']=Auth::user()->id;
        $model->update($data);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Coupons Update Successfuly'), 'goto' => route('admin.eCommerce.coupons.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $model = Coupon::findOrFail($id);
        $model->delete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Coupons Delete Successfuly'), 'goto' => route('admin.eCommerce.coupons.index')]);
    }
}
