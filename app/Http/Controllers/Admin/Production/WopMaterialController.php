<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Production\Product;
use App\models\Production\WopMaterial;
use App\models\Production\WorkOrder;
use App\models\Production\WorkOrderProduct;
use Yajra\DataTables\Facades\DataTables;

class WopMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('production_wop_materials.view')) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.production.wop-materials.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = WorkOrder::where('status', '=', 'requisition')->get();
            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('code', function ($document) {
                    return $document->prefix . numer_padding($document->code, get_option('digits_work_order_code'));
                })->addColumn('action', function ($model) {
                    return view('admin.production.wop-materials.action', compact('model'));
                })->rawColumns(['action'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('production_wop_materials.create')) {
            abort(403, 'Unauthorized action.');
        }
        $models = WorkOrder::where('status', '!=', 'requisition')->get();
        return view('admin.production.wop-materials.create', compact('models'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('production_wop_materials.create')) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'wo_id' => 'required',
            'raw_material' => 'required',
        ]);

        $wo_id = $request->wo_id;
        $raw_material = $request->raw_material;

        foreach ($raw_material as $key => $value) {
            $wop_id = $key;
            foreach ($value as $v) {
                $purchase = new WopMaterial;
                $purchase->wo_id = $wo_id;
                $purchase->wop_id = $wop_id;
                $purchase->raw_material_id = $v['raw_material_id'];
                $purchase->qty = $v['qty'];
                $purchase->price = $v['price'];
                $purchase->unit_price = $v['unit_price'];
                $purchase->waste = $v['waste'];
                $purchase->uses = $v['uses'];
                $purchase->created_by = auth()->user()->id;
                $purchase->save();
            }
        }

        $work_order = WorkOrder::findOrFail($wo_id);
        $work_order->status = 'requisition';
        $work_order->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'goto' => route('admin.production-wop-materials.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can('production_wop_materials.view')) {
            abort(403, 'Unauthorized action.');
        }
        $models = WorkOrder::with('work_order')->findOrFail($id);
        return view('admin.production.wop-materials.show', compact('models'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can('production_wop_materials.update')) {
            abort(403, 'Unauthorized action.');
        }
        $models = WorkOrder::findOrFail($id);
        return view('admin.production.wop-materials.edit', compact('models','id'));
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
        if (!auth()->user()->can('production_wop_materials.update')) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'wo_id' => 'required',
            'raw_material' => 'required',
        ]);

        if ($id) {
            $type = WopMaterial::where('wo_id', $id)->delete();
        }

        $raw_material = $request->raw_material;

        foreach ($raw_material as $key => $value) {
            $wop_id = $key;
            foreach ($value as $v) {
                $purchase = new WopMaterial;
                $purchase->wo_id = $id;
                $purchase->wop_id = $wop_id;
                $purchase->raw_material_id = $v['raw_material_id'];
                $purchase->qty = $v['qty'];
                $purchase->price = $v['price'];
                $purchase->unit_price = $v['unit_price'];
                $purchase->waste = $v['waste'];
                $purchase->uses = $v['uses'];
                $purchase->updated_by = auth()->user()->id;
                $purchase->save();
            }
        }

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated'), 'goto' => route('admin.production-wop-materials.index')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('production_wop_materials.delete')) {
            abort(403, 'Unauthorized action.');
        }
        if ($id) {
            $type = WopMaterial::where('wo_id', $id)->delete();
        }
        $work_order = WorkOrder::findOrFail($id);
        $work_order->status = '0';
        $work_order->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data deleted'), 'load' => true]);
    }


    public function product(Request $request)
    {
        $models = WorkOrder::with('workOrderProduct')->where('id',$request->id)->first();
        return view('admin.production.wop-materials.product', compact('models'));
    }
}
