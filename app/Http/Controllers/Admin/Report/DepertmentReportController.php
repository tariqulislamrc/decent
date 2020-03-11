<?php

namespace App\Http\Controllers\admin\Report;

use App\Http\Controllers\Controller;
use App\User;
use App\models\Production\WorkOrder;
use App\models\depertment\Depertment;
use App\models\depertment\ProductFlow;
use Illuminate\Http\Request;

class DepertmentReportController extends Controller
{
      public function product_report(){
       $orders =WorkOrder::all();
       $depertments =Depertment::all();
       $users =User::all();
      	return view('admin.report.depertment.product_report',compact('depertments','orders','users'));
      }

      public function get_product_report(Request $request)
      {
      	$depertment_id =$request->depertment_id;
      	$work_order_id =$request->work_order_id;
      	$user_id =$request->user_id;
      	$sDate =$request->sDate;
      	$eDate =$request->eDate;

      	$q =ProductFlow::query();
      	if ($depertment_id) {
      		$order =Depertment::find($depertment_id);
      		if ($order->flow=='First') {
      		    $q= $q->where('depertment_id',$depertment_id);
      		}
      		else{
      			$q= $q->where('send_depertment_id',$depertment_id);
      		}
      	}
      	if ($work_order_id=='All') {
      		$q=$q;
      	}
      	else
      	{
      		$q= $q->where('work_order_id',$work_order_id);	
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
      	$result =$q->get();
      	return view('admin.report.depertment.product_report_print',compact('result','sDate','eDate','depertment_id','order'));
      }
}
