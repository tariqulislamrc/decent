<?php

namespace App\Http\Controllers\admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Production\Product;
use App\models\Production\Variation;
use Yajra\DataTables\DataTables;

class HotSaleProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.eCommerce.hotsale.index');
    }

     //datatable
     public function datatable(Request $request){
        if ($request->ajax()) {
            $document = Product::where('hot_sale_status',1)->get();
            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('photo', function ($model) {
                    if($model->photo != NULL) {
                        $url= asset('storage/product/'.$model->photo);
                    } 
                    return '<img width="100px;" src="'.($model->photo != NULL ? $url : '').'" alt="Image of Product">';
                })
                ->editColumn('category', function ($model) {
                    return $model->category->name;
                })
                ->editColumn('sub_category', function ($model) {
                    return $model->sub_category->name;
                })
                ->editColumn('price', function ($model) {
                    $find_price =  Variation::where('product_id', $model->id)->get();
                    if(count($find_price) > 0) {
                        $total_product_variation = count($find_price);
                        $price = 0;
                        foreach($find_price as $row) {
                            $default_price = $row['default_sell_price'];
                            $price = $price + $default_price;
                        }
                
                        $per_product_price = round($price / $total_product_variation) ; 
                    } else {
                        $per_product_price = '';
                    }

                    return '৳'. $per_product_price;
                })
                ->rawColumns(['category','sub_category', 'price', 'photo'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.eCommerce.hotsale.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        $id = $request->id;

        $check = Product::findOrFail($id);
        
        if($check->hot_sale_status == 1) {
            $status = null;
        } else {
            $status = 1;
        }

        $check->hot_sale_status = $status;
        $check->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Feature Product Status is Successfully Changed')]);
    }
}
