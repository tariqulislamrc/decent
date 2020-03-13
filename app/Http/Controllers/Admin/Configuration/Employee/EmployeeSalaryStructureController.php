<?php

namespace App\Http\Controllers\Admin\Configuration\Employee;

use App\Http\Controllers\Admin\Employee\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\employee\Employee;
use App\models\employee\EmployeeSalary;
use App\models\employee\EmployeeSalaryDetail;
use App\models\employee\PayHead;
use App\models\employee\PayrollTemplate;
use App\models\employee\PayrollTemplateDetail;
use Illuminate\Support\Str;
use Yajra\Datatables\Datatables;

class EmployeeSalaryStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employee.payroll.structure.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $documents = EmployeeSalary::query();
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
        // find all employee list
        $employees = Employee::all();
        
        // find all Template
        $templates = PayrollTemplate::where('is_active', 1)->get();

        // return 
        return view('admin.employee.payroll.structure.create', compact('employees', 'templates'));
    }

    public function ajaxcall(Request $request) {
        // ->where('category', '<>', 'computation')
        $id = $request->id;
        $details = PayrollTemplateDetail::where('payroll_template_id', $id)->with('payhead')->get();
        return view('admin.employee.payroll.structure.ajax', compact('details'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate data from form
        $request->validate([
            'employee_id'   =>   'required',
            'date_effective'   =>   'required',
            'payroll_template_id'   =>   'required',
        ]);

        $payroll_template_id = $request->payroll_template_id;

        $uuid =  Str::uuid()->toString();

        $count_template_details_id = count($request->template_details_id);

        $count_amount = count($request->amount);

        $net_salary = 0;
        
        if($count_amount == $count_template_details_id) {

            $total_earning = 0;

            $total_deduction = 0;

            for($i = 0; $i < $count_template_details_id; $i++) {

                $template_id = $request->template_details_id[$i];

                $amount = $request->amount[$i];

                $template_model = PayrollTemplateDetail::where('id', $template_id)->first();

                $template_alias_id = $request->template_details_id[0];

                $alias_template = PayrollTemplateDetail::where('id', $template_alias_id)->first();

                $pay_head_alias = $alias_template->payhead->alias;

                


                if($template_model) {

                    $category = $template_model->category;
                    
                    $cat_id = $template_model->id;

                    if($category == 'computation') {

                        if($i == 0) {

                            return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang('Sorry. Basic Must Be Flat Ratio')]);
                            die();

                        }

                        // find the category information 

                        $cat_info = PayrollTemplateDetail::where('id', $cat_id)->first();
                        
                        // find the computation login
                        $computation = $cat_info->computation;

                        $explode_computation = explode('*', $computation);

                        $alias = $explode_computation[0];
                        
                        dd($pay_head_alias);
                        if($pay_head_alias == $alias) {
                            dd('ok');
                        } else {
                            dd('problem');
                        }



                    } else {

                        $payhead_status = $template_model->payhead->type;
                        
                        if($payhead_status == 'Earning') {

                            $total_earning = $total_earning + $amount;

                        } else {

                            $total_deduction = $total_deduction + $amount;
                        }

                    }

                } else {

                    return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang('Sorry. Wrong Template Deails')]);

                }

            }

            $total_salary = $total_earning - $total_deduction ; 

            $model = new EmployeeSalary;
            $model->uuid = $uuid;
            $model->employee_id = $request->employee_id;
            $model->payroll_template_id = $request->payroll_template_id;
            $model->date_effective = $request->date_effective;
            $model->total_earning = $total_earning;
            $model->total_deduction = $total_deduction;
            $model->net_salary = $total_salary;
            $model->description = $request->description;
            $model->save();

            $employee_salary_id = $model->id;

            for($i = 0; $i < $count_template_details_id; $i++) {

                $template_id = $request->template_details_id[$i];

                $amount = $request->amount[$i];

                $template_model = PayrollTemplateDetail::where('id', $template_id)->first();

                $template_details_id = $template_model->id;

                $item = new EmployeeSalaryDetail;
                $item->employee_salary_id = $employee_salary_id;
                $item->payroll_template_detail_id = $template_details_id;
                $item->amount = $amount;
                $item->save();
            }
            
        } else {

            return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang('Sorry. Amount Not Matched')]);

        }

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Salary Structure Created')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = EmployeeSalary::where('uuid', $id)->firstOrFail();

        return view('admin.employee.payroll.structure.show', compact('model'));
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
        $model = EmployeeSalary::where('uuid', $id)->firstOrFail();
        $model->delete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Salary Structure Deleted')]);
        
    }
}
