<?php

namespace App\Http\Controllers\Admin\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\employee\EmployeeSalary;
use App\models\employee\Payrolls;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

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
                    $name = find_employee_name_using_employee_id($document->employee_id);
                    $desig = employee_designation($document->employee_id);
                    $department = employee_department($document->employee_id);

                    $output = $name . '<br>' . $desig . '<strong>('. $department .')</strong>';
                    return $output;
                })
                ->editColumn('payroll_period', function ($document) {
                    return carbonDate(Carbon::parse($document->start_date)) . ' - '. carbonDate(Carbon::parse($document->end_date)) ;
                })
                ->editColumn('net_salary', function ($document) {
                    $usd = get_option('currency') && get_option('currency') != '' ? get_option('currency') : 'BDT';
                    $salary = $document->total;
                    return $usd . ' ' . $salary;
                })
                ->editColumn('status', function ($document) {
                    if($document->status == 'paid') {
                        $output = '<span class="badge badge-primary">Paid</span>';
                    } elseif($document->status == 'partial') {
                        $output = '<span class="badge badge-info">Partital</span>';
                    } else {
                        $output = '<span class="badge badge-danger">Due</span>';
                    }

                    return $output;
                })
                ->addColumn('action', function ($model) {
                    return view('admin.employee.payroll.payroll.action', compact('model'));
                })->rawColumns(['action', 'employee', 'payroll_period', 'status', 'net_salary'])->make(true);
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

        $salary = EmployeeSalary::where('employee_id', $emploee_id)->orderBy('created_at')->first();

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
        $request->validate([
            'employee_id'       =>      'required',
            'employee_salary_id'       =>      'required',
            'start_date'       =>      'required',
            'end_date'       =>      'required',
            'per_day_calculation_basis'       =>      'required',
            'total'       =>      'required',
        ]);
        $uuid =  Str::uuid()->toString();

        $model = new Payrolls;
        $model->uuid = $uuid;
        $model->employee_id = $request->employee_id;
        $model->employee_salary_id = $request->employee_salary_id;
        $model->start_date = $request->start_date;
        $model->end_date = $request->end_date;
        $model->per_day_calculation_basis = $request->per_day_calculation_basis;
        $model->total = $request->total;
        $model->paid = 0;
        $model->payment_status = 'Due';
        $model->remarks = $request->remarks;
        $model->save();

        // Activity Log
        activity()->log('Created a Employee Payroll- ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'goto' => route('admin.payroll-initialize.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Payrolls::where('uuid', $id)->firstOrFail();
        $start_date = $model->start_date;
        $end_date = $model->end_date;
        $salary = EmployeeSalary::where('id', $model->employee_salary_id)->first();

        return view('admin.employee.payroll.payroll.show', compact('model', 'salary', 'start_date', 'end_date'));
    }

    // print 
    public function print($id) {
        $model = Payrolls::where('uuid', $id)->firstOrFail();
        $start_date = $model->start_date;
        $end_date = $model->end_date;
        $salary = EmployeeSalary::where('id', $model->employee_salary_id)->first();

        return view('admin.employee.payroll.payroll.print', compact('model', 'salary', 'start_date', 'end_date'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dd($id);
        $model = Payrolls::where('uuid', $id)->firstOrFail();
        $start_date = $model->start_date;
        $end_date = $model->end_date;
        $salary = EmployeeSalary::where('id', $model->employee_salary_id)->first();

        dd($model);

        return view('admin.employee.payroll.payroll.print', compact('model', 'salary', 'start_date', 'end_date'));
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
        $model = Payrolls::where('uuid',$id)->firstOrFail();
        $model->delete();

        // Activity Log
        activity()->log('Deleted a Employee Payroll- ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted')]);
    }
}
