<?php

namespace App\Http\Controllers\Admin\Configuration\Employee;

use App\models\employee\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\employee\Department;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\employee\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\employee\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\employee\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\employee\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
// Employee Department Section

    public function Department_index()
    {
        return view('admin.employee.department.index');
    }


    // Datatable Data
    public function Department_datatable(Request $request)
    {
        if ($request->ajax()) {
            $department = Department::where('name', '!=', config('system.default_role.admin'))->get();
            return Datatables::of($department)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return view('admin.employee.department.action', compact('model'));
                })->rawColumns(['action'])->make(true);
        }
    }

    public function Department_create()
    {
        return view('admin.employee.department.create');
    }


    public function Department_store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|unique:departments|max:255',
            'description' => '',
        ]);

        $model = new Department;
        $model->name = $request->name;
        $model->description = $request->description;
        $model->save();
        // Activity Log
        activity()->log('Created a Employee Department - ' . $request->name);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'goto' => route('admin.employee.department.index')]);

    }

    public function Department_edit($id)
    {
        // find the data
        $model = Department::where('id', $id)->firstOrFail();
        // return
        return view('admin.employee.department.edit', compact('model'));
    }
    public function Department_update(Request $request, $id)
    {
        $validator = $request->validate([
            'name' => 'required|max:255|unique:departments,name,'.$id,
            'description' => '',
        ]);
        $model = Department::findOrFail($id);
        $model->name = $request->name;
        $model->description = $request->description;
        $model->save();

        // Activity Log
        activity()->log('Update a Employee Department - ' . $request->name);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated'), 'goto' => route('admin.employee.department.index')]);
    }

    public function Department_delete(Request $request, $id)
    {
        $type = Department::findOrFail($id);
        $name = $type->name;
        $type->delete();

        // Activity Log
        activity()->log('Delete a Employee Department - ' . $name);

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully'), 'goto' => route('admin.employee.department.index')]);
    }
}
