<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Utilities\TransactionUtil;
use App\models\Production\Transaction;
use App\models\Production\TransactionPayment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TransactionPaymentController extends Controller
{

  protected $transactionUtil;
   public function __construct(TransactionUtil $transactionUtil)
    {
        $this->transactionUtil = $transactionUtil;
    }
   public function sales_payment(Request $request)

   {
   	   $validator = $request->validate([
            'payment_date'=>'required',
            'amount'=>'required|numeric',
        ]);

         $transaction = Transaction::find($request->get('transaction_id'));

        if ($transaction->paid+$request->amount>$transaction->net_total) {
             throw ValidationException::withMessages(['message' => _lang('Payble Amount Not> Net Total')]);
          }

            $ref_no = $request->get('reference_no');
            $previously_paid = $transaction->paid;
            $previously_due = $transaction->due;
            $transaction->paid = round(($previously_paid + $request->get('amount')), 2);
            $transaction->due = $previously_due-$request->get('amount');
            $transaction->save();

               //saving paid amount into payment table
            $payment =new TransactionPayment;
            $payment->transaction_id=$transaction->id;
            $payment->client_id=$transaction->client_id;
            $payment->method =$request->method;
            $payment->payment_date =$request->payment_date;
            $payment->transaction_no =$request->check_no;
            $payment->amount =$request->amount;
            $payment->note =$request->note;
            $payment->type ='Credit';
            $payment->created_by =auth()->user()->id;
            $payment->save();

            $this->transactionUtil->updatePaymentStatus($transaction->id, $transaction->net_total);
            return response()->json(['success' => true, 'status' => 'success', 'message' => 'Payment Successfully.', 'window' => route('admin.sale.pos.printpayment',$payment->id)]);
   }
}
