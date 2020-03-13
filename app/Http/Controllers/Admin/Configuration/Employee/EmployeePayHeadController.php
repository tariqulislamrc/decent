<?php

namespace App\Http\Controllers\Admin\Configuration\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\employee\PayHead;

class EmployeePayHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employee.pay-head.index');
    }

    public function datatable(Request $request)
    {
        // dd("l;kajsdfkl;sadjflk;jas");
        if ($request->ajax()) {
            $document = PayHead::where('name', '!=', config('system.default_role.admin'))->get();
            return Datatables::of($document)
                ->addIndexColumn()
                ->editColumn('is_active',function($model){
                    return $model->is_active == 1? '<span class="badge badge-success">Active</span>':'<span class="badge badge-danger">Inactive</span>';
                })
                ->editColumn('alias',function($model){
                    return $model->type == 'Earning' ? '<span class="badge badge-success">Earning</span>' : '<span class="badge badge-danger">Deduction</span>';
                })
                ->addColumn('action', function ($model) {
                    return view('admin.employee.pay-head.action', compact('model'));
                })->rawColumns(['action', 'alias', 'is_active'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.employee.pay-head.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:pay_heads|max:255',
            'alias' => 'required',
            'type' => 'required',
            'is_active' => 'required',
        ]);

        $model = new PayHead;

        $model->name = $request->name;

        $model->alias = $request->alias;

        $model->type = $request->type;

        $model->description = $request->description;

        $model->is_active = $request->is_active;

        $model->save();

        // Activity Log
        activity()->log('Created a Employee Pay Head - ' . $request->name);

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created')]);
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
        // find the data
        $model = PayHead::where('id', $id)->firstOrFail();

        // return
        return view('admin.employee.pay-head.edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
      {
        $request->validate([
            'name' => 'required|max:255',
            'alias' => 'required',
            'type' => 'required',
            'is_active' => 'required',
        ]);

        $model =  PayHead::findOrFail($id);

        $model->name = $request->name;

        $model->alias = $request->alias;

        $model->type = $request->type;

        $model->description = $request->description;

        $model->is_active = $request->is_active;

        $model->save();

        // Activity Log
        activity()->log('Update a Employee Pay Head - ' . $request->name);

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = PayHead::findOrFail($id);

        $name = $type->name;

        $type->delete();

        // Activity Log
        activity()->log('Delete a Employee Pay Head - ' . $name);

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}
