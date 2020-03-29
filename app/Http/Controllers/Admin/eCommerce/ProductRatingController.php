<?php

namespace App\Http\Controllers\Admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\ProductRating;
use Yajra\DataTables\DataTables;

class ProductRatingController extends Controller
{
    public function rating_index(Request $request)
    {
        return view('admin.eCommerce.product-rating.index');
    }
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = ProductRating::where('name', '!=', config('system.default_role.admin'))->get();
            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('status', function ($model) {
                    if ($model->status == '0') {
                        return '<span class="badge badge-danger">In Active</span>';
                    } else {
                        return '<span class="badge badge-success">Active</span>';
                    }
                })
                ->editColumn('product_name', function ($document) {
                    return $document->product ? $document->product->name : '';
                })
                ->addColumn('action', function ($model) {
                    return view('admin.eCommerce.product-rating.action', compact('model'));
                })
                ->rawColumns(['action', 'status'])->make(true);
        }
    }


    public function status($id)
    {
        $model = ProductRating::findOrFail($id);
        return view('admin.eCommerce.product-rating.status', compact('model'));
    }

    public function status_change(Request $request, $id)
    {
        $model = ProductRating::findOrFail($id);
        $model->status = $request->status;
        $model->save();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Status Change Successfuly')]);
    }


    public function destroy($id)
    {
        $type = ProductRating::findOrFail($id);
        $type->delete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully'), 'load' => true]);
    }
}