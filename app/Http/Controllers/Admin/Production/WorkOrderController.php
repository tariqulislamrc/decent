<?php

namespace App\Http\Controllers\Admin\Production;

use App\models\Production\Variation;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Production\WorkOrder;
use App\models\Production\WorkOrderProduct;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Yajra\Datatables\Datatables;
use App\models\Production\Brand;
use App\models\Production\Product;
use App\models\Production\ProductMaterial;
use App\models\Production\RawMaterial;
use Auth;

use Illuminate\Support\Str;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('admin.production.work_order.index');
    }


    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = WorkOrder::where('status', '!=', 'requisition')->get();
            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('code', function ($document) {
                    return $document->prefix . numer_padding($document->code, get_option('digits_work_order_code'));
                })->addColumn('action', function ($model) {
                    return view('admin.production.work_order.action', compact('model'));
                })->rawColumns(['action'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $brand = Brand::all();
        $models = Product::all();
        $code_prefix = get_option('work_order_code_prefix');
        $code_digits = get_option('digits_work_order_code');
        $uniqu_id = generate_id('workorder', false);
        $uniqu_id = numer_padding($uniqu_id, $code_digits);

        return view('admin.production.work_order.create', compact('brand', 'models', 'code_prefix', 'code_digits', 'uniqu_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'prefix' => '',
            'code' => '',
            'brand_id' => '',
            'type' => 'required|max:255',
            'date' => 'required|max:255',
            'delivery_date' => 'max:255',
        ]);

        $model = new WorkOrder;
        $model->prefix = $request->prefix;
        $model->code = $request->code;
        $model->brand_id = $request->brand_id;
        $model->type = $request->type;
        $model->date = $request->date;
        $model->delivery_date = $request->delivery_date;
        $model->status = 0;
        $model->hidden = 0;
        $model->tek_marks = 0;
        $model->created_by = Auth::user()->id;
        $success = $model->save();
        if ($success) {
            $count = count($request->product_id);
            for ($i = 0; $i < $count; $i++) {
                $line_purchase = new WorkOrderProduct;
                $line_purchase->workorder_id = $model->id;
                $line_purchase->product_id = $request->product_id[$i];
                $line_purchase->qty = $request->quantity[$i];
                $line_purchase->price = $request->price[$i];
                $line_purchase->sub_total = $request->sub_total[$i];
                $line_purchase->net_total = $request->net_total[$i];
                $line_purchase->status = 0;
                $line_purchase->hidden = 0;
                $line_purchase->tek_marks = 0;
                $line_purchase->created_by = Auth::user()->id;
                $line_purchase->save();
            }
        }
        generate_id("workorder", true);
        // Activity Log
        activity()->log('Created a Work order By - ' . Auth::user()->id);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data created Successfuly'), 'load' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $model = WorkOrder::findOrFail($id);
        return view('admin.production.work_order.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $brand = Brand::all();
        $model = WorkOrder::findOrFail($id);
        return view('admin.production.work_order.edit', compact('model', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'prefix' => '',
            'code' => '',
            'brand_id' => '',
            'type' => 'required|max:255',
            'date' => 'required|max:255',
            'delivery_date' => 'max:255',
        ]);

        $model = WorkOrder::findOrFail($id);
        $model->prefix = $request->prefix;
        $model->code = $request->code;
        $model->brand_id = $request->brand_id;
        $model->type = $request->type;
        $model->date = $request->date;
        $model->delivery_date = $request->delivery_date;
        $model->status = 0;
        $model->hidden = 0;
        $model->tek_marks = 0;
        $model->created_by = Auth::user()->id;
        $success = $model->save();
        $line_purchase = WorkOrderProduct::where('workorder_id', $id)->delete();
        if ($success) {
            $count = count($request->product_id);
            for ($i = 0; $i < $count; $i++) {
                $line_purchase = new WorkOrderProduct;
                $line_purchase->workorder_id = $id;
                $line_purchase->product_id = $request->product_id[$i];
                $line_purchase->qty = $request->quantity[$i];
                $line_purchase->price = $request->price[$i];
                $line_purchase->sub_total = $request->sub_total[$i];
                $line_purchase->net_total = $request->net_total[$i];
                $line_purchase->status = 0;
                $line_purchase->hidden = 0;
                $line_purchase->tek_marks = 0;
                $line_purchase->updated_by = Auth::user()->id;
                $line_purchase->save();
            }
        }
        // Activity Log
        activity()->log('updated a Work order By - ' . Auth::user()->id);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data created Successfuly'), 'load' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $model = WorkOrder::findOrFail($id);
        $model->delete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data deleted'), 'load' => true]);
    }

    public function item(Request $request)
    {
        $model = Product::find($request->product_id);
        return response()->json($model);
    }


    public function append(Request $request)
    {
        $product_id = $request->product_id;
        $variation_id = $request->variation_id;
        $row = $request->row_count;

        if (!empty($product_id)) {
            $product = Product::where('id', $product_id)
                ->first();

            $query = Variation::where('product_id', $product_id)
                ->with(['value1', 'value2']);
            if ($variation_id !== '0') {
                $query->where('id', $variation_id);
            }

            $variations = $query->get();
            $html = view('admin.production.work_order.include.itemlist')
                ->with(compact(
                    'product',
                    'variations',
                    'row',
                    'variation_id'
                ))->render();

        }
        return response()->json(['product_id' => $product_id, 'variation_id' => $variation_id, 'html' => $html]);
    }

    // getCatagory
    public function getProduct()
    {

        $term = request()->term;
        $products = Product::leftJoin(
            'variations',
            'products.id',
            '=',
            'variations.product_id'
        )->where(function ($query) use ($term) {
            $query->where('products.name', 'like', '%' . $term . '%');
            $query->orWhere('articel', 'like', '%' . $term . '%');
            $query->orWhere('prefix', 'like', '%' . $term . '%');
            $query->orWhere('sub_sku', 'like', '%' . $term . '%');

        })
            ->orderBy('products.id', 'DESC')
            ->select(
                'products.id as product_id',
                'products.name',
                // 'products.sku as sku',
                'variations.id as variation_id',
                'variations.name as variation',
                'variations.sub_sku as sub_sku'
            )
            ->get();
        $products_array = [];
        foreach ($products as $product) {
            $products_array[$product->product_id]['name'] = $product->name;
            $products_array[$product->product_id]['articel'] = $product->sub_sku;
            $products_array[$product->product_id]['variations'][]
                = [
                'variation_id' => $product->variation_id,
                'variation_name' => $product->variation,
                'sub_sku' => $product->sub_sku,
            ];
        }

        $result = [];
        $i = 1;
        if (!empty($products_array)) {
            foreach ($products_array as $key => $value) {

                $name = $value['name'];
                foreach ($value['variations'] as $variation) {
                    $text = $name;
                        $text = $text . ' (' . $variation['variation_name'] . ')';
                    $i++;
                    $result[] = ['id' => $i,
                        'text' => $text . ' - ' . $variation['sub_sku'],
                        'product_id' => $key,
                        'variation_id' => $variation['variation_id'],
                    ];
                }
                $i++;
            }
        }

        return json_encode($result);
    }

    public function getCatagoryParent($id, $name = Null)
    {
        $category = Product::find($id);
        if ($category) {
            $name = $category->name;
        }
        return $name;
    }
}
