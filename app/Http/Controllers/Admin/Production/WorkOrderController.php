<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Production\WorkOrder;
use App\models\Production\WorkOrderProduct;
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
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.production.work_order.index');
    }


    public function datatable(Request $request){
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
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $brand = Brand::all();
        $models = Product::all();
        $code_prefix = get_option('work_order_code_prefix');
        $code_digits = get_option('digits_work_order_code');
        $uniqu_id = generate_id('employee', false);
        $uniqu_id = numer_padding($uniqu_id, $code_digits);

        return view('admin.production.work_order.create',compact('brand','models','code_prefix','code_digits','uniqu_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
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
            for ($i=0; $i < $count; $i++) { 
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
        // Activity Log
        activity()->log('Created a Work order By - ' . Auth::user()->id);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data created Successfuly'),'load'=>true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $model = WorkOrder::findOrFail($id);
        return view('admin.production.work_order.show',compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $brand = Brand::all();
        $model = WorkOrder::findOrFail($id);
        return view('admin.production.work_order.edit',compact('model','brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
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
        $line_purchase = WorkOrderProduct::where('workorder_id',$id)->delete();
        if ($success) {
            $count = count($request->product_id);
            for ($i=0; $i < $count; $i++) { 
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
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data created Successfuly'),'load'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $model = WorkOrder::findOrFail($id);
        $model->delete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data deleted'),'load'=>true]);
    }

    public function item(Request $request){
        $model =Product::find($request->product_id);
        return response()->json($model);
    }


    public function append(Request $request){
        $product = $request->product;
        $quantity = $request->quantity;
        $row = $request->row;
        $price = $request->price;
        $model =Product::find($product);
        return view('admin.production.work_order.include.itemlist',compact('model','quantity','row','price'));
    }

      // getCatagory
    public function getProduct(){
        $people = [];
        $data = [];

        $people = Product::where('name', 'like', '%' . $_GET['term'] . '%')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($people as $k => $v) {
            $data[$k]['id'] = $v->id;
            $data[$k]['name'] = $this->getCatagoryParent($v->id);
        }
        return response()->json(['items' => $data]);
    }

    public function getCatagoryParent($id, $name = Null){
        $category = Product::find($id);
        if ($category) {
            $name =  $category->name;
        }
        return $name;
    }
}
