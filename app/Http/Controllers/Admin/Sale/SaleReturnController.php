<?php

namespace App\Http\Controllers\admin\Sale;

use App\Http\Controllers\Controller;
use App\Utilities\TransactionUtil;
use App\models\Production\Transaction;
use App\models\inventory\ReturnTransaction;
use App\models\inventory\TransactionSellLine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

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
    public function index(Request $request)
    {
        if (!auth()->user()->can('sale_pos.view')) {
            abort(403, 'Unauthorized action.');
        }
      if ($request->ajax()) {
        if (!auth()->user()->hasRole('Super Admin')) {
          $document = Transaction::orderBy('id','DESC')->where('transaction_type','Sale')->where('return',1)->where('hidden',false)->get();
        }else{
          $document = Transaction::orderBy('id','DESC')->where('transaction_type','Sale')->where('return',1)->get();
           }
           return DataTables::of($document)
                ->addIndexColumn()
                 ->editColumn('reference_no', function ($model) {
                  return '<a href="'.route('admin.sale.pos.show',$model->id).'" target="_blank">'.$model->reference_no.'</a>';
                 })
                 ->editColumn('client', function ($model) {
                  return $model->client?$model->client->name:'';
                 })
                 ->editColumn('sale', function ($model) {
                    if (auth()->user()->can("view_sale.sale_price")) {
                    return $model->net_total;
                    }else{
                        return 'N/A';
                    }
                 })
                ->editColumn('return', function ($model) {
                    if (auth()->user()->can("view_sale.return_amt")) {
                    return $model->return_parent->sum('net_total');
                    }else{
                        return 'N/A';
                    }
                 })
                ->addColumn('action', function ($model) {
                    return view('admin.sale_return.action', compact('model'));
                })->rawColumns(['action','client','reference_no','sale','return'])->make(true);
      }  
      return view('admin.sale_return.index');
    }



    public function return_sale(Request $request,$id)
    {
        if (!auth()->user()->can('sale_pos.view')) {
            abort(403, 'Unauthorized action.');
        }
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
        if (!auth()->user()->can('sale_pos.view')) {
            abort(403, 'Unauthorized action.');
        }
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


            //return transaction
            $return_sell =new ReturnTransaction;
            $return_sell->transaction_id=$transaction->id;
            $return_sell->transaction_sell_line_id=$request->return[$key]['sale_id'];
            $return_sell->client_id =$transaction->client_id;
            $return_sell->sells_reference_no =$transaction->reference_no;
            $return_sell->return_units=$request->return[$key]['return_units'];
            $return_sell->return_amount=$request->return[$key]['return_units']*$request->return[$key]['unit_price'];
            $return_sell->returned_by =auth()->user()->id;
            $return_sell->returned_type ='Sale';
            $return_sell->save();

            }
        }

     if($total_return_quantity <= 0){
        throw ValidationException::withMessages(['message' => _lang('You Cant return Zero Quantity')]);
      }

      if (isset($request->discount)) {
            $discount =$request->discount;
        }

        $newtarns =new Transaction;
        $newtarns->reference_no=$ref_no;
        $newtarns->client_id =$transaction->client_id;
        $newtarns->transaction_type ='sale_return';
        $newtarns->sale_type =$transaction->sale_type;
        $newtarns->brand_id=$transaction->brand_id;
        $newtarns->discount =$discount;
        $newtarns->discount_type ='Fixed';
        $newtarns->discount_amount =$discount;
        $newtarns->sub_total =$total_amount;
        $newtarns->net_total =$total_amount-$discount;
        $newtarns->return_parent_id = $transaction->id;
        $newtarns->date =Carbon::parse(date('Y-m-d'))->format('Y-m-d H:i:s');
        $newtarns->save();
        $transaction->return =true;
        $transaction->save();  

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Sales Return'),'window'=>route('admin.sale.return.printpage',$transaction->id)]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    if (!auth()->user()->can('sale_pos.view')) {
            abort(403, 'Unauthorized action.');
        }
      $model =Transaction::find($id);
      return view('admin.sale_return.show',compact('model'));
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

    public function printpage($id)
    {
        $model =Transaction::find($id);
        return view('admin.sale_return.printpage',compact('model'));
    }
}
