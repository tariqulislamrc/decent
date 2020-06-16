<?php

namespace App\Http\Controllers\Admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\EcommerceProduct;
use App\models\Production\Product;
use App\models\Production\VariationBrandDetails;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class ProductionToEcommerceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.eCommerce.production-to-ecommerce.index');
    }

    // datatable
    public function datatable(Request $request){
        if ($request->ajax()) {
             $document = EcommerceProduct::all();
             return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('product', function ($model) {
                    return $model->product ? $model->product->name : 'No Product Found';
                })
                ->editColumn('variation', function ($model) {
                    return $model->variation ? $model->variation->name : 'No Variation Found';
                })
                ->editColumn('date', function ($model) {
                    return formatDate($model->created_at);
                })
                ->rawColumns(['product', 'variation', 'date'])->make(true);
         }
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.eCommerce.production-to-ecommerce.create');
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
            'variation_id' => 'required',
            'product_id' => 'required',
            'variation' => 'required',
            'product' => 'required',
            'avaiable_qty' => 'required',
            'stock_qty' => 'required',
        ]);

        for ($i = 0; $i < count($request->product_id); $i++) {
            $variation_id = $request->variation_id[$i];
            $product_id = $request->product_id[$i];
            $variation = $request->variation[$i];
            $product = $request->product[$i];
            $avaiable_qty = $request->avaiable_qty[$i];
            $stock_qty = $request->stock_qty[$i];

            // check the stock transfer qty is not greater then avaiable qty
            if($avaiable_qty < $stock_qty) {
                $data = $product . ' - '. $variation. ' Pass quantity is greater then available quantity!';
                return response()->json(['status'=>true, 'status' => 'danger', 'message' => $data ]); 
            }

            // update main variation quantity
            $query = VariationBrandDetails::where('product_id', $product_id)->where('variation_id', $variation_id)->first();
            if($query) {
                $query->qty_available = $avaiable_qty - $stock_qty;
                $product_variation_id = $query->product_variation_id;
                $query->save();
            } else {
                $data = $product . ' - '. $variation. ' is not a valid Product';
                return response()->json(['status'=>true, 'status' => 'danger', 'message' => $data ]); 
            }

            // store the ecommerce quantity\
            $model = new EcommerceProduct;
            $model->product_id = $product_id;
            $model->product_variation_id = $product_variation_id;
            $model->variation_id = $variation_id;
            $model->quantity = $stock_qty;
            $model->save();

        };

        return response()->json(['status'=>true, 'status' => 'success', 'message' => 'Stock is Successfully Uploaded!', 'goto' => route('admin.eCommerce.production-to-ecommerce.index') ]); 

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
