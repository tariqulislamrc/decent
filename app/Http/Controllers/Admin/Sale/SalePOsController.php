<?php

namespace App\Http\Controllers\admin\Sale;

use App\Http\Controllers\Controller;
use App\models\Production\Brand;
use App\models\Production\Category;
use App\models\Production\Product;
use Illuminate\Http\Request;

class SalePOsController extends Controller
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
    public function create()
    {
        $brands =Brand::select('id','name')->get();
        $categories=Category::all();
        return view('admin.salePos.create',compact('brands','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function getProductSuggestion(Request $request)
    {
         if ($request->ajax()) {
            $category_id = $request->get('category_id');
            $brand_id = $request->get('brand_id')?:1;
            $term = $request->get('term');

            $check_qty = false;

        $products = Product::leftJoin(
            'variations',
            'products.id',
            '=',
            'variations.product_id'
        )
        ->leftjoin('variation_brand_details AS VBD',
             function ($join) use ($brand_id) {
                $join->on('variations.id', '=', 'VBD.variation_id');
                     //Include Location
                                if (!empty($brand_id)) {
                                    $join->where(function ($query) use ($brand_id) {
                                        $query->where('VBD.brand_id', '=', $brand_id);
                                        //Check null to show products even if no quantity is available in a location.
                                        //TODO: Maybe add a settings to show product not available at a location or not.
                                        $query->orWhereNull('VBD.brand_id');
                                    });
                                    ;
                                }
          });
        if (!empty($term)) {
        $products->where(function ($query) use ($term) {
            $query->where('products.name', 'like', '%' . $term . '%');
            $query->orWhere('articel', 'like', '%' . $term . '%');
            $query->orWhere('prefix', 'like', '%' . $term . '%');
            $query->orWhere('sub_sku', 'like', '%' . $term . '%');
           
        });
        }
         if ($category_id != 'all') {
                $products->where(function ($query) use ($category_id) {
                    $query->where('products.category_id', $category_id);
                    $query->orWhere('products.sub_category_id', $category_id);
                });
          }
           $products = $products->select(
                'products.id as product_id',
                'products.name',
                'variations.id as variation_id',
                'variations.name as variation',
                'VBD.qty_available as qty',
                'variations.default_sell_price as selling_price',
                'variations.sub_sku',
                'products.photo as image'
            );
            $products=$products->orderBy('products.id', 'DESC')
                     ->groupBy('variations.id')
            // ->select(
            // 'VBD.qty_available as qty', 
            //        'variations.id as variation_id',
            //        'products.id as product_id'
            //    )
           ->paginate(20);
            return view('admin.salePos.partials.product_list')
                    ->with(compact('products'));
        }
    }

    public function get_variation_product(Request $request)
    {
        $query = Variation::join('products AS p', 'variations.product_id', '=', 'p.id')
                ->join('product_variations AS pv', 'variations.product_variation_id', '=', 'pv.id')
                ->leftjoin('variation_brand_details AS vbd', 'variations.id', '=', 'vbd.variation_id')
                ->where('p.business_id', $business_id)
                ->where('variations.id', $variation_id);
    }
}
