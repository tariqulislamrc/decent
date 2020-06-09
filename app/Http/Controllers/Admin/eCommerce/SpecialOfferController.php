<?php

namespace App\Http\Controllers\Admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\SpecialOffer;
use App\models\eCommerce\SpecialOfferItem;
use App\models\Production\Product;
use App\models\Production\ProductPhoto;
use App\models\Production\VariationBrandDetails;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class SpecialOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.eCommerce.special-offer.index');
    }

        //datatable
        public function datatable(Request $request){
            if ($request->ajax()) {
                $document = SpecialOffer::all();
                return DataTables::of($document)
                    ->addIndexColumn()
                    ->editColumn('photo', function ($model) {
                        if($model->photo != NULL) {
                            $url= asset('storage/special-offer/'.$model->photo);
                        } else {
                            $url = asset('img/product.jpg');
                        }
                        return '<img width="100px;" src="'.($model->photo != NULL ? $url : $url).'" alt="Image of Product">';
                    })
                    ->editColumn('product', function ($model) {
                        return SpecialOfferItem::where('special_offer_id', $model->id)->count();
                        // return $model->category->name;
                    })
                    ->editColumn('action', function ($model) {
                        return view('admin.eCommerce.special-offer.action', compact('model'));
                    })
                    ->rawColumns(['photo', 'product', 'action'])->make(true);
            }
        }
      

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    $brand_id = get_option('default_brand');       
    $brand_id = $request->get('brand_id')?:get_option('default_brand');
    $term = $request->get('term');
    $check_qty = false;
    $products = Product::leftJoin(
        'variations',
        'products.id',
        '=',
        'variations.product_id'
    )
    ->join('product_photos','product_photos.product_id', '=', 'products.id')
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
    if (!empty($brand_id)) {
        $products->where('VBD.brand_id', $brand_id);
    }
      $category_id = request()->get('category_id', null);
        if (!empty($category_id)) {
            $products->where('products.category_id', $category_id);
        }

       $products = $products->select(
            'products.id as product_id',
            'products.name as pro_name',
            'variations.id as variation_id',
            'variations.name as variation',
            'VBD.qty_available as qty',
            'variations.default_sell_price as selling_price',
            'variations.sub_sku as sku',
            'VBD.brand_id as brand_id',
            'products.photo as image',
            'product_photos.photo as photo'
        );
        $document = $products->orderBy('VBD.qty_available', 'desc')->groupBy('variations.id')
        ->get();
    //    dd($document);
        // $products = Product::whereIn('id', $product_id)->orderBy('avarage_retting', 'DESC')->take(3)->get();

        return view('admin.eCommerce.special-offer.create', compact('document'));
    }

    // add_to_special_offer_row
    public function add_to_special_offer_row(Request $request) {
        
        $row = $request->row;
        $product_id = $request->product_id;
        $product = Product::where('id', $product_id)->first();
        $photo = ProductPhoto::select('photo')->where('product_id', $product_id)->first();
        if($photo) {
            $photo = $photo->photo;
        } else {
            $photo = '';
        }
        return view('admin.eCommerce.special-offer.add_product', compact('row', 'product', 'photo'));
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
}
