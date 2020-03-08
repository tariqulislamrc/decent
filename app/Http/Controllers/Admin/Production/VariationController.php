<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Production\VariationTemplate;
use App\models\Production\VariationTemplateDetails;
use Auth;
use Yajra\DataTables\Facades\DataTables;

class VariationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.production.variation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.production.variation.create');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $variation = VariationTemplate::where('name', '!=', config('system.default_role.admin'))->get();
            return DataTables::of($variation)
                ->addIndexColumn()
                ->editColumn('variation_value', function ($variation) {
                    return $variation->name;
                })
                ->editColumn('values', function ($variation) {
                    $output = ''; 
                    foreach ($variation as $attr) {
                        $id = $variation->id;
                        $models = VariationTemplateDetails::where('variation_template_id', $id)->get();
                    }
                    return view('admin.production.variation.badge', compact('models'));
                })
                ->editColumn('status', function ($variation) {
                    if($variation->status == 1) {
                        $status = '<span class="badge badge-success">Active</span>';
                    } else {
                        $status = '<span class="badge badge-danger">Inactivective</span>';
                    }

                    return $status;
                })
                ->addColumn('action', function ($model) {
                    return view('admin.production.variation.action', compact('model'));
                })->rawColumns(['action', 'values', 'status'])->make(true);
        }
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
            'name' => 'required|string|max:255',
            'status' => 'required',
         ]);

        $name = $request->name;
        $status = $request->status;

        $model = new VariationTemplate;
        $model->name = $name;
        $model->status = $status;
        $model->hidden = 0;
        $model->tek_marks = 0;
        $model->created_by = Auth::user()->id;
        $model->save();

        $variation_id = $model->id;

        $value = $request->value;

        $count = count($value);

        for($i = 0; $i < $count ; $i++) {
            $item = new VariationTemplateDetails;
            $item->variation_template_id = $variation_id;
            $item->name = $value[$i];
            $item->hidden = 0;
            $item->tek_marks = 0;
            $item->created_by = Auth::user()->id;
            $item->save();
        }

        // Activity Log
        activity()->log('Created a Variation Template - ' . $name );
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Variaion Created') , 'load' => true]);
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
        $model = VariationTemplate::findOrFail($id);
        
        // all variation template values
        $models = VariationTemplateDetails::where('variation_template_id', $id)->get();
        
        return view('admin.production.variation.edit', compact('model', 'models'));
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
            'name' => 'required',
            'status' => 'required',
        ]);

        $model = VariationTemplate::findOrFail($id);
        $model->name = $request->name;
        $model->status = $request->status;
        $model->updated_by = Auth::user()->id;
        $model->save();

        $values = $request->value;
        foreach($values as $key => $item) {
            
            $variation_details_id = $key;
            $variation_details_value = $item;

            $check = VariationTemplateDetails::where('id', $variation_details_id)->where('variation_template_id', $id)->first();
            if($check) {
                $check->name = $variation_details_value;
                $check->updated_by = Auth::user()->id;
                $check->save();
            } else {
                $model = new VariationTemplateDetails;
                $model->variation_template_id = $id;
                $model->name = $variation_details_value;
                $model->hidden = 0;
                $model->tek_marks = 0;
                $model->created_by = Auth::user()->id;
                $model->save();
            }
        }

        // Activity Log
        activity()->log('Updated a Variation Template - ' . $request->name );
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Variaion Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = VariationTemplate::findOrFail($id);
        $model->delete();

        // Activity Log
        activity()->log('Updated a Variation Template - ' . $model->name );
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Variaion Deleted'), 'load' => true]);
    }
}
