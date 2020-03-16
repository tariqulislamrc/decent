<?php

namespace App\Http\Controllers\admin\employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\employee\Employee;
use App\models\employee\Payrolls;

class PayrollTransectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.employee.payroll.transection.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        return view('admin.employee.payroll.transection.create', compact('employees'));
    }

    // ajax 
    public function ajax(Request $request) {
        $val = $request->val;
        return view('admin.employee.payroll.transection.ajax', compact('val'));
    }

    // check_employee_payroll
    public function check_employee_payroll(Request $request) {
        
        $id = $request->val;

        $payroll = Payrolls::where('employee_id', $id)->where('payment_status', '!=', 'Paid')->first();

        if($payroll) {
            $due = $payroll->total - $payroll->paid;
            $usd = get_option('currency') && get_option('currency') != '' ? get_option('currency') : 'BDT'  ;

            echo '<span class="text-success">Payroll #'.$payroll->id . 'from '. $payroll->start_date . ' to '. $payroll->end_date . ' unpaid amount '. $usd . ' '.  $due . '</span>';
        } else {
            echo '<span class="text-danger">No Unpaid payroll found</span>';
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
            'employee_id'    =>   'required',
            'date'    =>   'required',
            'amount'    =>   'required',
            'payment_method'    =>   'required',
            'head'              =>  'required',
        ]);

        $payroll = Payrolls::where('employee_id', $request->employee_id)->where('payment_status', '!=', 'Paid')->first();
        if(!$payroll) {
            return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang('No Unpaid payroll found for this Employee')]);
        }

        // Date of transaction cannot be less than payroll end date.
        if($request->head == 'Salary Payment') {
            $payroll_end_date = $payroll->end_date;
            $date_of_tx = $request->date;
            if(strtotime($date_of_tx) < strtotime($payroll_end_date)) {
                return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang('Date of transaction cannot be less than payroll end date.')]);
            }
        }

        // Amount is greater than payroll balance ₹1,100
        $payroll_balance = $payroll->total;
        $amount = intval($request->amount);
        if($amount > $payroll_balance) {
            $due = $payroll->total - $payroll->paid;
            $usd = get_option('currency') && get_option('currency') != '' ? get_option('currency') : 'BDT'  ;
            $output = 'Amount is greater than payroll balance '. $usd . ' ' . $due ;
            return response()->json(['success' => true, 'status' => 'danger', 'message' => _lang($output)]);
        }


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
