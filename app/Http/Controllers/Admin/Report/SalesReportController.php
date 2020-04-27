<?php

namespace App\Http\Controllers\admin\Report;

use App\Http\Controllers\Controller;
use App\User;
use App\models\Client;
use App\models\Production\Transaction;
use App\models\Production\TransactionPayment;
use Illuminate\Http\Request;

class SalesReportController extends Controller
{
    public function index()
    {
    	$client =Client::all();
    	$users =User::all();

    	return view('admin.report.selling.index',compact('client','users'));
    }


    public function get_sales_report(Request $request)

    {
    	$client_id =$request->client_id;
        $user_id =$request->user_id;
        $sDate =$request->sDate;
        $eDate =$request->eDate;

    	$q =Transaction::query();

	    if ($client_id=='All') {
        	$q=$q;	
        }
        else{           	
           $q =$q->where('client_id',$client_id);
        }
        if ($user_id=='All') {
            $q=$q;
        }
        else{
            $q= $q->where('created_by',$user_id);     
        }
        if ($sDate && $eDate) {
            $q=$q->whereBetween('date',[$sDate,$eDate]);
        }
        $q =$q->where('transaction_type','Sale');
        $result=$q->get();
        return view('admin.report.selling.sales_report_print',compact('result','sDate','eDate'));
    }

    public function sales_payment()
    {
    	$client =Client::all();
    	$refs =Transaction::where('transaction_type','Sale')->select('reference_no','id')->get();
    	return view('admin.report.selling.sales_payment',compact('client','refs'));
    }


    public function sales_payment_report(Request $request)
    {
    	$client_id =$request->client_id;
        $transaction_id =$request->transaction_id;
        $sDate =$request->sDate;
        $eDate =$request->eDate;

        $q =TransactionPayment::query();
        if ($client_id=='All') {
        	$q=$q;	
        }
        else{           	
           $q =$q->where('client_id',$client_id);
        }
        if ($transaction_id=='All') {
            $q=$q;
        }
        else{
            $q= $q->where('transaction_id',$transaction_id);     
        }
        if ($sDate && $eDate) {
            $q=$q->whereBetween('payment_date',[$sDate,$eDate]);
        }
        $q =$q->where('type','Credit');
        $result=$q->groupBy('transaction_id')->select('transaction_id','client_id')->get();
        return view('admin.report.selling.sales_payment_report_print',compact('result','sDate','eDate'));

    }

    public function sales_due()
    {
    	$client =Client::all();
    	$users =User::all();
    	return view('admin.report.selling.sales_due',compact('client','users'));
    }

    public function sales_due_report(Request $request)
    {
    	$client_id =$request->client_id;
        $user_id =$request->user_id;
        $sDate =$request->sDate;
        $eDate =$request->eDate;

    	$q =Transaction::query();

	    if ($client_id=='All') {
        	$q=$q;	
        }
        else{           	
           $q =$q->where('client_id',$client_id);
        }
        if ($user_id=='All') {
            $q=$q;
        }
        else{
            $q= $q->where('created_by',$user_id);     
        }
        if ($sDate && $eDate) {
            $q=$q->whereBetween('date',[$sDate,$eDate]);
        }
        $q =$q->where('transaction_type','Sale');
        $result=$q->get();
        return view('admin.report.selling.sales__due_report_print',compact('result','sDate','eDate'));
    }


    public function sale_return()
    {
    	$refs =Transaction::where('transaction_type','Sale')
    	                           ->where('return',true)
    	                           ->get();
    	$client =Client::all();
    	$users =User::all();
    	return view('admin.report.selling.sale_return',compact('refs','client','users'));                           
    }

    public function sale_return_report(Request $request)
    {
        $client_id =$request->client_id;
        $transaction_id =$request->transaction_id;
        $user_id =$request->user_id;
        $sDate =$request->sDate;
        $eDate =$request->eDate;

        $q =Transaction::query();

        if ($client_id=='All') {
            $q=$q;  
        }
        else{               
           $q =$q->where('client_id',$client_id);
        }
        if ($transaction_id=='All') {
            $q=$q;
        }
        else{
            $q= $q->where('return_parent_id',$transaction_id);     
        }
        if ($user_id=='All') {
            $q=$q;
        }
        else{
            $q= $q->where('created_by',$user_id);     
        }
        if ($sDate && $eDate) {
            $q=$q->whereBetween('date',[$sDate,$eDate]);
        }
        $q =$q->where('transaction_type','sale_return');
        $result=$q->groupBy('return_parent_id')->select('return_parent_id','client_id')->get();
        return view('admin.report.selling.sales__return_report_print',compact('result','sDate','eDate')); 
    }
}
