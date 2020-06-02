<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\JobWork;
use App\Utilities\TransactionUtil;
use App\models\Production\Transaction;
use App\models\Production\TransactionPayment;
use App\models\Production\VariationTemplate;
use App\models\Production\WorkOrder;
use App\models\Production\WorkOrderProduct;
use App\models\depertment\Depertment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class JobworkController extends Controller
{

	protected $transactionUtil;
   public function __construct(TransactionUtil $transactionUtil)
    {
        $this->transactionUtil = $transactionUtil;
    }

    public function index(Request $request)
    {
    	   if ($request->ajax()) {
            $q=Transaction::query();
            $q =$q->where('transaction_type','job_work');
            $document =$q->get();

            return DataTables::of($document)
                ->addIndexColumn()
                 ->editColumn('date', function ($model) {
                  return formatDate($model->date);
                 })
                 ->editColumn('paid', function ($model) {
                    return $model->payment()->sum('amount');
                 })
                ->editColumn('due', function ($model) {
                    return $model->net_total-($model->payment()->sum('amount'));
                 })
                 ->editColumn('payment_status', function ($model) {
                   if ($model->payment_status=='paid') {
                      return '<span class="badge badge-success">Paid</span>';
                   }
                   elseif($model->payment_status=='partial'){
                     return '<span class="badge badge-info">Partial</span>';
                   }
                   else{
                    return '<span class="badge badge-danger">Due</span>';
                   }
                 })
                ->addColumn('action', function ($model) {
                    return view('admin.job_work.action', compact('model'));
                })->rawColumns(['action','date','paid','due','payment_status'])->make(true);
        }
      return view('admin.job_work.index');
    }

    public function create()
    {
    	$workorder =WorkOrder::all();
    	$depertments =Depertment::select('id','name')->get();
    	return view('admin.job_work.create',compact('workorder','depertments'));
    }


    public function get_job_product(Request $request)
    {
    	
        $variations =VariationTemplate::all();
            $products = WorkOrderProduct::
                join('variations', 'work_order_products.variation_id', '=', 'variations.id')
                ->where('work_order_products.workorder_id',$request->id)
                ->select('variations.*')
                ->distinct('product_id')
                ->get();
                if (isset($products)) {
                	 return view('admin.job_work.get_product',compact('variations','products')); 
                }
              
        
    }


    public function job_work_post(Request $request)
    {

    	$ym = Carbon::now()->format('Y/m');

        $row = Transaction::where('transaction_type', 'job_work')->withTrashed()->get()->count() > 0 ? Transaction::where('transaction_type', 'job_work')->withTrashed()->get()->count() + 1 : 1;
        
        $ref_no = $ym.'/job-'.ref($row);
        $transaction_data['date']=Carbon::now()->format('Y-m-d H:i:s');
        $transaction_data['type']='Debit';
        $transaction_data['reference_no']=$ref_no;
        $transaction_data['transaction_type']='job_work';
        $transaction_data['sub_total']=$request->sub_total;
        $transaction_data['shipping_charges']=$request->shipping_charges;
        $transaction_data['net_total']=$request->net_total;
        $transaction_data['paid']=$request->paid;
        $transaction_data['due']=$request->due;
        $transaction_data['job_work_status']='pendding';
        $transaction_data['job_work_reason']=$request->job_work_reason;
        $transaction_data['job_work_company']=$request->job_work_company;

        if ($request->hidden_qty>0) {
          $transaction =Transaction::create($transaction_data);
           for ($i=0; $i <count($request->qty) ; $i++) { 
            if ($request->qty[$i]>0) {
            $model =new JobWork;
            $model->transaction_id =$transaction->id;
            $model->depertment_id=$request->department_id;
            $model->product_id=$request->product_id[$i];
            $model->variation_id=$request->variation_id[$i];
            $model->work_order_id=$request->work_order_id;
            $model->qty=$request->qty[$i];
            $model->date=date('Y-m-d');
            $model->status='pendding';
            $model->created_by=auth()->user()->id;
            $model->save();
          }
         }

           if (!empty($transaction_data['paid'])) {
            $payment =new TransactionPayment;
            $payment->transaction_id=$transaction->id;
            $payment->method ='Cash';
            $payment->payment_date =$transaction_data['date'];
            $payment->amount =$request->paid;
            $payment->type ='Debit';
            $payment->created_by =auth()->user()->id;
            $payment->save();
        }

        //Update payment status
         $this->transactionUtil->updatePaymentStatus($transaction->id, $transaction->net_total);

          return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Information Updated')]);
        }
        else
        {
        	throw ValidationException::withMessages(['message' => _lang('You Have No Qty To Job Work')]);
        }

    }

    public function edit($id)
    {
    	 $model = Transaction::where('transaction_type', 'job_work')
                        ->with(['job_works'])
                        ->find($id);  
        $depertments =Depertment::select('id','name')->get();                                              
       return view('admin.job_work.accept',compact('model','depertments'));
    }

    public function update(Request $request)
    {
      dd($request->all());
    }
}
