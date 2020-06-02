<?php

namespace App\Http\Controllers\admin\eCommerce;

use App\EcommerceOffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Production\Product;
use App\models\Production\Variation;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class eCommerceOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('admin.eCommerce.offer.index');
    }

    //  Datatable 
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = EcommerceOffer::all();
            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('photo', function ($document) {
                    if($document->image != NULL) {
                        $url= asset('storage/offer/'.$document->image);
                    } 
                    return '<img width="100px;" src="'.$url.'" alt="Image of Product">';
                })
                ->addColumn('action', function ($model) {
                    return view('admin.eCommerce.offer.action', compact('model'));
                })->rawColumns(['action', 'photo'])->make(true);
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
        return view('admin.eCommerce.offer.create', compact('products'));
    }
    
    // check_price
    public function check_price(Request $request) {
        $id = $request->id;
        $find_price = Variation::where('product_id', $id)->get();
        if(count($find_price) > 0) {
            $total_product_variation = count($find_price);
            $price = 0;
            foreach($find_price as $row) {
                $default_price = $row['default_sell_price'];
                $price = $price + $default_price;
            }
    
            $per_product_price = round($price / $total_product_variation) ;
            
        } else {
            $per_product_price = 'Sorry No Variation Found';
        }

        return $per_product_price;
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
            'size'  =>      'required',
            'product_id'  =>      'required',
            'old_price'  =>      'required',
            'new_price'  =>      'required',
            'image'  =>      'required|mimes:jpeg,jpg,png | max:2000',
            'heading'  =>      'required',
            'sub_heading'  =>      'required',
        ]);

        $uuid = Str::uuid()->toString();

        $model = new EcommerceOffer;
        $model->uuid = $uuid;
        $model->size = $request->size;
        $model->product_id = $request->product_id;
        $model->old_price = $request->old_price;
        $model->new_price = $request->new_price;
        
        if ($request->hasFile('image')) {
            $storagepath = $request->file('image')->store('public/offer');
            $fileName = basename($storagepath);
            $model->image = $fileName;
        } else {
            $model->image = '';
        }

        $model->heading = $request->heading;
        $model->sub_heading = $request->sub_heading;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Offer Created')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = EcommerceOffer::findOrFail($id);
        $products = Product::all();
        return view('admin.eCommerce.offer.edit', compact('products', 'model'));
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
        $request->validate([
            'size'  =>      'required',
            'product_id'  =>      'required',
            'old_price'  =>      'required',
            'new_price'  =>      'required',
            'image'  =>      'required|mimes:jpeg,jpg,png | max:2000',
            'heading'  =>      'required',
            'sub_heading'  =>      'required',
        ]);

        $uuid = Str::uuid()->toString();

        $model = EcommerceOffer::findOrFail($id);

        $old_photo = '';
        $old_photo = $request->old_photo;

        $model->uuid = $uuid;
        $model->size = $request->size;
        $model->product_id = $request->product_id;
        $model->old_price = $request->old_price;
        $model->new_price = $request->new_price;
        
        if ($request->hasFile('photo')) {
            if ($model->photo) {
                $image_path = public_path() . '/storage/offer/' . $model->photo;
                unlink($image_path);
            }
            $storagepath = $request->file('photo')->store('public/product');
            $fileName = basename($storagepath);
            $model->photo = $fileName;
        } else {
            $model->photo = $old_photo;
        }

        $model->heading = $request->heading;
        $model->sub_heading = $request->sub_heading;
        $model->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Offer Updated')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = EcommerceOffer::findOrFail($id);

        if ($model->photo) {
            $image_path = public_path() . '/storage/offer/' . $model->photo;
            unlink($image_path);
        }
        
        $model->delete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Offer Deleted')]);
    }
}