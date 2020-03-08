<?php

namespace App\Http\Controllers\Admin\Configuration\Employee;

use App\models\employee\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
// use App\models\employee\Designation;
use App\models\employee\EmployeeCategory;
use Illuminate\Validation\Rule;

class EmployeeDesignationController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
        $categories = EmployeeCategory::all();
        $designations = Designation::all();
        return view('admin.employee.designation.index',compact('categories','designations'));
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = Designation::where('name', '!=', config('system.default_role.admin'))->get();
            return Datatables::of($document)
            ->addIndexColumn()
            ->editColumn('employee_category_id', function ($model) {
                return $model->category?$model->category->name:'';
            })
            ->editColumn('top_designation_id', function ($model) {
                return $model->designation?$model->designation->name:'';
            })
            ->addColumn('action', function ($model) {
                return view('admin.employee.designation.action', compact('model'));
            })->rawColumns(['action'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = EmployeeCategory::all();
        $designations = Designation::all();
        return view('admin.employee.designation.create',compact('categories','designations'));
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
            'name' => 'required|unique:designations|max:255',
            'employee_category_id' => 'required',
            
        ]);

        $model = new Designation;
        $model->employee_category_id = $request->employee_category_id;
        $model->name = $request->name;
        $model->top_designation_id = $request->top_designation_id;
        $model->description = $request->description;
        $model->save();
        // Activity Log
        activity()->log('Created a Employee Designation - ' . $request->name);
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
        $model = Designation::where('id', $id)->firstOrFail();
        $categories = EmployeeCategory::all();
        $designations = Designation::whereNotIn('id', [$id])->get();
        // return
        return view('admin.employee.designation.edit', compact('model','categories','designations'));
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
        //   dd("amar sonar bangla");
        $model =  Designation::findOrFail($id);
        $request->validate([
          'name' => ['required', 'string', 'max:255',
          Rule::unique('designations', 'name')->ignore($model->id)],            'employee_category_id' => 'required',

      ]);

        $model->employee_category_id = $request->employee_category_id;
        $model->name = $request->name;
        $model->top_designation_id = $request->top_designation_id;
        $model->description = $request->description;
        $model->save();

        // Activity Log
        activity()->log('Update a Employee Designation - ' . $request->name);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated'), 'goto' => route('admin.designation.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Designation::findOrFail($id);
        $name = $type->name;
        $type->delete();

        // Activity Log
        activity()->log('Delete a Employee Designation - ' . $name);

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully'), 'goto' => route('admin.designation.index')]);
    }
}
