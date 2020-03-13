<?php

namespace App\Http\Controllers\Admin\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\employee\Employee;
use App\models\employee\EmployeeSalary;
use App\models\employee\Payrolls;
use Yajra\Datatables\Datatables;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employee.payroll.payroll.index');
    }

    // Ajax DataTable
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $documents = Payrolls::query();
                return Datatables::of($documents)
                ->addIndexColumn()
                ->editColumn('employee', function ($document) {
                    return $document->employee->name ;
                })
                ->editColumn('payroll_template', function ($document) {
                    return $document->payroll_template->name ;
                })
                ->editColumn('date_effective', function ($document) {
                    return carbonDate($document->date_effective);
                })
                ->editColumn('net_salary', function ($document) {
                    $usd = get_option('currency') && get_option('currency') != '' ? get_option('currency') : 'BDT';
                    $salary = $document->net_salary;
                    return $usd . ' ' . $salary;
                })
                ->addColumn('action', function ($model) {
                    return view('admin.employee.payroll.structure.action', compact('model'));
                })->rawColumns(['action', 'employee', 'payroll_template', 'net_salary'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();     

        return view('admin.employee.payroll.payroll.create', compact('employees'));
    }

    // step_one
    public function step_one(Request $request) {
        
        $request->validate([
            'employee_id'       =>      'required',
            'start_date'       =>      'required',
            'end_date'       =>      'required',
        ]);

        $emploee_id = $request->employee_id;
        
        $start_date = $request->start_date;

        $end_date = $request->end_date;

        $salary = EmployeeSalary::where('employee_id', $emploee_id)->latest()->first();

        if($salary) {

            $date_of_effective = $salary->date_effective;


            if(strtotime($date_of_effective) < strtotime($request->start_date)) {
                
                $html = view('admin.employee.payroll.payroll.step_two', compact('salary', 'start_date', 'end_date'))->render();

                return response()->json(['success' => true, 'html' => $html, 'message' => _lang('Salary Structure Not Found For This Employee.')]);
          
            } else {
                
                return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang('Could not find selected salary structure..')]);
                
            }

        } else {

            return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang('Salary Structure Not Found For This Employee.')]);
                            
        }
        
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
