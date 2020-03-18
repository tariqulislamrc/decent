<?php

namespace App\Http\Controllers\admin\Sale;

use App\Http\Controllers\Controller;
use App\Utilities\TransactionUtil;
use App\models\Production\Transaction;
use App\models\inventory\TransactionSellLine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SaleReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $transactionUtil;
    public function __construct(TransactionUtil $transactionUtil)
    {
        $this->transactionUtil = $transactionUtil;
    }
    public function index()
    {
      
    }



    public function return_sale(Request $request,$id)
    {
       $model =Transaction::find($id);
       return view('admin.sale_return.add',compact('model'));
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
        $transaction =Transaction::find($request->transaction_id);
        $previoussub_Total = $transaction->sub_total;
        $previousnet_Total = $transaction->net_total;
        $total_return_quantity = 0;
        $total_amount = 0;
        $discount = 0;


        $ym = Carbon::now()->format('Y/m');

        $row = Transaction::where('transaction_type', 'sale_return')->withTrashed()->get()->count() > 0 ? Transaction::where('transaction_type', 'sale_return')->withTrashed()->get()->count() + 1 : 1;
        
        $ref_no = $ym.'/SR-'.ref($row);

        foreach ($request->return as $key => $value) {
            if ($request->return[$key]['return_units']>0) {
              $total_return_quantity += $request->return[$key]['return_units'];
              $sale_line =TransactionSellLine::find($request->return[$key]['sale_id']);

            if ($request->return[$key]['return_units']>$sale_line->quantity-$sale_line->quantity_returned) {
               throw ValidationException::withMessages(['message' => _lang('Return Qty Not Greater Than Total Qty')]);
              }
              $sale_line->quantity_returned =$request->return[$key]['return_units'];

              //toatl amount after return
              $total_amount += $sale_line->unit_price*$request->return[$key]['return_units'];
              $sale_line->save();
              $this->transactionUtil->IncreaseVariationQty($request->return[$key]['product_id'],$request->return[$key]['variation_id'],$transaction->brand_id,$request->return[$key]['return_units']);

            }
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
