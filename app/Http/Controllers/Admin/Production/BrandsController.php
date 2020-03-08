<?php

namespace App\Http\Controllers\Admin\Production;

use App\Http\Controllers\Controller;
use App\models\Production\Brand;
use App\models\email\EmailTemolate;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;


class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.production.brand.index');
    }


    public function datatable(Request $request){
       if ($request->ajax()) {
            $document = Brand::where('name', '!=', config('system.default_role.admin'))->get();
            return DataTables::of($document)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return view('admin.production.brand.action', compact('model'));
                })->rawColumns(['action'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.production.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:brands|max:255',
            'owner_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => '',
        ]);

        $model = new Brand;
        $model->name = $request->name;
        $model->owner_name = $request->owner_name;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->address = $request->address;
        $model->hidden = 0;
        $model->tek_marks = 0;
        $model->created_by = Auth::user()->id;
        $model->save();

        // Activity Log
        activity()->log('Created a Production Brand - ' . Auth::user()->id);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data created Successfuly') ]);
    }

    public function remort_modal()
    {
        return view('admin.production.brand.quickmodal');
    }

   public function addremort_modal(Request $request)
    {
     $request->validate([
            'name' => 'required|unique:brands|max:255',
            'owner_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => '',
        ]);

        $model = new Brand;
        $model->name = $request->name;
        $model->owner_name = $request->owner_name;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->address = $request->address;
        $model->hidden = 0;
        $model->tek_marks = 0;
        $model->created_by = Auth::user()->id;
        $model->save();
        return response()->json(['id'=>$model->id,'name'=>$model->name,'addto'=>'brand_append','modal'=>'brand_modal']);
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
        $model = Brand::findOrFail($id);
        return view('admin.production.brand.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $model =  Brand::findOrFail($id);
         $request->validate([
            'name' => ['required',Rule::unique('brands')->ignore($model->id)],
            'owner_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => '',
        ]);
        $model->name = $request->name;
        $model->owner_name = $request->owner_name;
        $model->email = $request->email;
        $model->phone = $request->phone;
        $model->address = $request->address;
        $model->hidden = 0;
        $model->tek_marks = 0;
        $model->updated_by = Auth::user()->id;
        $model->save();

        // Activity Log
        activity()->log('Update a Production Brand - ' . Auth::user()->id);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Update Successfuly')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $type = Brand::findOrFail($id);
        $name = $type->name;
        $type->delete();

        activity()->log('Delete a Brand - ' . $name);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully'), 'load'=>true]);
    }

  public function email($id)
    {
        $model =Brand::find($id);
        $templates = EmailTemolate::pluck('name','id');
        return view('admin.production.brand.mail',compact('model','templates'));
    }

    public function sms($id)
    {
        $model =Brand::find($id);
        return view('admin.production.brand.sms',compact('model'));
    }
}
