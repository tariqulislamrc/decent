<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Production\Category;
use App\models\Production\Product;
use App\models\Production\ProductMaterial;
use App\models\Production\RawMaterial;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.production.product.index');
    }

    public function datatable(Request $request){
        if ($request->ajax()) {
            $document = Product::where('name', '!=', config('system.default_role.admin'))->get();
            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('code', function ($document) {
                    return $document->prefix . numer_padding($document->code, get_option('digits_production_code'));
                })
                ->editColumn('category_id', function ($document) {                                                                    
                    return $document->category->name;
                })
                ->editColumn('sub_category_id', function ($document) {                                                                    
                    return $document->sub_category->name;
                })
                ->editColumn('status', function ($document) {
                    if ($document->status == 'Active') {
                        return '<span class="badge badge-success">' . 'Active' . '</span>';
                    } else if ($document->status == 'InActive') {
                        return '<span class="badge badge-danger">' . 'Inactive' . '</span>';
                    }
                })
                ->addColumn('action', function ($model) {
                    return view('admin.production.product.action', compact('model'));
                })->rawColumns(['action', 'status'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $categorys = Category::where('parent_id', 0)->select('id', 'name')->get();
        $models = RawMaterial::all();
        $code_prefix = get_option('production_code_prefix');
        $code_digits = get_option('digits_production_code');
        $uniqu_id = generate_id('product', false);
        $uniqu_id = numer_padding($uniqu_id, $code_digits);

        // retrurn the employee create page
        return view('admin.production.product.create', compact('models',"categorys","code_prefix", "uniqu_id"));
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
            'prefix' => 'required',
            'code' => 'required',
            'name' => 'required',
            'catagory_id' => 'required',
            'sub_category' => 'required',
            'status' => 'required',
            'photo' => 'mimes:jpeg,jpg,png | max:2000',
        ]);


            $uuid =  Str::uuid()->toString();
            if ($request->articel) {
                $articel = $request->articel;
            }else{
                $articel = 'articel';
            }

            $product = new Product;

            if ($request->hasFile('photo')) {
                $storagepath = $request->file('photo')->store('public/product');
                $fileName = basename($storagepath);
                $product->photo = $fileName;
            }else{
                $product->photo = '';
            }

            $product->uuid = $uuid;
            $product->code = $request->code;
            $product->prefix = $request->prefix;
            $product->articel = $articel;
            $product->name = $request->name;
            $product->category_id = $request->catagory_id;
            $product->sub_category_id = $request->sub_category;
            $product->description = $request->description;
            $product->status = $request->status;
            $product->created_by = auth()->user()->id;
            $product->save();
            $id = $product->id;


            for ($i = 0; $i < count($request->raw_material); $i++) {
                $purchase = new ProductMaterial;
                $purchase->product_id = $id;
                $purchase->material_id = $request->raw_material[$i];
                $purchase->qty = $request->qty[$i];
                $purchase->price = $request->price[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->waste = $request->waste[$i];
                $purchase->uses = $request->uses[$i];
                $purchase->status = $request->raw_status[$i];
                $purchase->description = $request->raw_description[$i];
                $purchase->unit_id = $request->unit[$i];
                $purchase->created_by = auth()->user()->id;

                $purchase->save();
            }

        generate_id("product", true);

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'goto' => route('admin.production-product.index')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('material')->findOrFail($id);
        return view('admin.production.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('material')->findOrFail($id);
        // dd($product);
        $categorys = Category::where('parent_id', 0)->select('id', 'name')->get();
        $models = RawMaterial::all();
        $code_prefix = get_option('production_code_prefix');
        $code_digits = get_option('digits_production_code');
        $uniqu_id = generate_id('employee', false);
        $uniqu_id = numer_padding($uniqu_id, $code_digits);

        // retrurn the employee create page
        return view('admin.production.product.edit', compact('product','models', "categorys"));
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
        if ($request->articel) {
            $articel = $request->articel;
        } else {
            $articel = 'articel';
        }

        $old_photo = '';
        $old_photo = $request->old_photo;

        $product = Product::findOrFail($id);

        if ($request->hasFile('photo')) {
            if ($product->photo) {
                $image_path = public_path() . '/storage/product/' . $product->photo;
                unlink($image_path);
            }
            $storagepath = $request->file('photo')->store('public/product');
            $fileName = basename($storagepath);
            $product->photo = $fileName;
        } else {
            $product->photo = $old_photo;
        }

        $product->articel = $articel;
        $product->name = $request->name;
        $product->category_id = $request->catagory_id;
        $product->sub_category_id = $request->sub_category;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->updated_by = auth()->user()->id;
        $product->save();
        $id = $product->id;

        if ($id) {
            $type = ProductMaterial::where('product_id',$id)->delete();
        }

        for ($i = 0; $i < count($request->raw_material); $i++) {
            $purchase = new ProductMaterial;
            $purchase->product_id = $id;
            $purchase->material_id = $request->raw_material[$i];
            $purchase->qty = $request->qty[$i];
            $purchase->price = $request->price[$i];
            $purchase->unit_price = $request->unit_price[$i];
            $purchase->waste = $request->waste[$i];
            $purchase->uses = $request->uses[$i];
            $purchase->status = $request->raw_status[$i];
            $purchase->description = $request->raw_description[$i];
            $purchase->unit_id = $request->unit[$i];
            $purchase->updated_by = auth()->user()->id;
            $purchase->save();
        }

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated'), 'goto' => route('admin.production-product.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Product::findOrFail($id);
        $name = $type->name;

        if ($type->photo) {
            $image_path = public_path() . '/storage/product/' . $type->photo;
            unlink($image_path);
        }

        $type->delete();

        // Activity Log
        activity()->log('Delete a Production Product - ' . $name);

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully'), 'goto' => route('admin.production-product.index')]);
    }

    public function category(Request $request)
    {
        $data = Category::where('parent_id', $request->id)->select('id', 'name')->get();

        // retrurn the employee create page
        return response()->json($data);
    }


    public function get_product(Request $request, $id)
    {
        $product = RawMaterial::with('unit')->find($id);
        return response()->json($product);
    }

    public function product_add(Request $request)
    {
        $product = $request->product;
        $unit = $request->unit;
        $unit_price = $request->unit_price;
        $quantity = $request->quantity;
        $Price = $request->grossPrice;
        $waste = $request->waste;
        $uses = $request->uses;
        $status = $request->raw_status;
        $description = $request->raw_description;

        $model = RawMaterial::find($product);
        return view('admin.production.product.include.itemlist', compact('unit', 'unit_price','model', 'quantity', 'Price', 'waste', 'uses', 'status', 'description'));
    }



}
