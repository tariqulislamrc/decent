<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\employee\IdCardTemplate;
use App\models\employee\Department;
use App\models\employee\Employee;
use App\models\employee\EmployeeDesignation;

class IdCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.id-card.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = IdCardTemplate::where('name', '!=', config('system.default_role.admin'))->get();
            return Datatables::of($document)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return view('admin.id-card.action', compact('model'));
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
        return view('admin.id-card.create');
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
            'name' => 'required',
            'width' => 'required',
            'height' => 'required',
            'show_per_page' => 'required',
        ]);

        $model = new IdCardTemplate;
        $model->name = $request->name;
        $model->type = 'Employee';
        $model->width = $request->width;
        $model->height = $request->height;
        $model->show_per_page = $request->show_per_page;
        $model->save();

        // Activity Log
        activity()->log('Created a Employee Id Card Template - ' . $request->name);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $department = EmployeeDesignation::where('department_id', $request->department)->get();
        $employee_id = [];
        foreach ($department as  $value) {
           $employee_id[] = $value->employee_id;
        }
        $employee = Employee::whereIn('id', $employee_id)->get();
        if (count($employee)) {
            return view('admin.id-card.show', compact('employee'));
        }else{
            return back()->withErrors(['field_name' => ['Employee Not Found']]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = IdCardTemplate::findOrFail($id);
        return view('admin.id-card.edit', compact('model'));
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
        $model = IdCardTemplate::findOrFail($id);
        $model->name = $request->name;
        $model->width = $request->width;
        $model->height = $request->height;
        $model->show_per_page = $request->show_per_page;
        $model->save();

        // Activity Log
        activity()->log('Created a Employee Id Card Template - ' . $request->name);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = IdCardTemplate::findOrFail($id);
        $name = $type->name;
        $type->delete();

        // Activity Log
        activity()->log('Created a Employee Id Card Template - ' . $name);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }

    public function id_card()
    {
        $department = Department::all();
        $card = IdCardTemplate::all();
        return view('admin.id-card.id-card', compact('department','card'));
    }
}
