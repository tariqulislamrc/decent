<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\models\Production\Product;
use App\models\Production\ProductMaterial;
use Illuminate\Http\Request;

class PairCostingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!auth()->user()->can('paircosting.view')) {
            abort(403, 'Unauthorized action.');
        }
        if ($request->ajax()) {
           
           $product_id =$request->product_id;
           $model=Product::with(['material'])->find($product_id);
           return view('admin.pair_costing.ajax_include',compact('model'));
        }
        $products =Product::select('id','name')->get();
        return view('admin.pair_costing.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('paircosting.create')) {
            abort(403, 'Unauthorized action.');
        }
        $product_id =$request->product_id;
        $model=Product::with(['variation'])->find($product_id);
        for ($i=0; $i <count($request->consumstion) ; $i++) { 
           
           $pro_material =ProductMaterial::where('product_id',$product_id)->where('material_id',$request->material_id[$i])->first();
           $pro_material->qty =$request->consumstion[$i];
           $pro_material->unit_price =$request->unit_cost[$i];
           $pro_material->price =$request->cost_pr[$i];
           $pro_material->description =$request->description[$i];
           $pro_material->save();
        }

        foreach ($model->variation as $key => $value) {
            
            $value->default_purchase_price =$request->total_material_cost;
            $value->rejection =$request->rejection;
            $value->rejection_amt =$request->rejection_amt;
            $value->profit_percent =$request->profit_percent;
            $value->profit_amt =$request->profit_amt;
            $value->commercial =$request->commercial;
            $value->default_sell_price =$request->grand_total;
            $value->save();


        }
            $model->default_purchase_price =$request->total_material_cost;
            $model->rejection =$request->rejection;
            $model->rejection_amt =$request->rejection_amt;
            $model->profit_percent =$request->profit_percent;
            $model->profit_amt =$request->profit_amt;
            $model->commercial =$request->commercial;
            $model->default_sell_price =$request->grand_total;
            $model->save();

            activity()->log('Paircosting Updated - ' . $model->id);


        return response()->json(['success' => true, 'status' => 'success', 'message' => ' Successfully.','window'=>route('admin.paircosting.show',$model->id)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $model=Product::with(['material'])->find($id);

          return view('admin.pair_costing.show',compact('model'));
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
