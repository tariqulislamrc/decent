<?php

namespace App\Http\Controllers\admin\Production;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Production\Unit;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.production.unit.index');
    }

    public function datatable(Request $request){
       if ($request->ajax()) {
            $document = Unit::all();
            return DataTables::of($document)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return view('admin.production.unit.action', compact('model'));
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
        return view('admin.production.unit.form');
    }

    public function remort_modal()
    {
        return view('admin.production.unit.quickmodal');
    }

    public function addremort_modal(Request $request)
    {
       $validator = $request->validate([
            'unit'=>'required',
            'child_unit'=>'nullable',
            'convert_rate'=>'nullable|numeric',
        ]);

        $unit = new Unit;
        $unit->unit =$request->unit;
        if ($request->check==1) {
          $unit->child_unit =$request->child_unit;
          $unit->convert_rate =$request->convert_rate;
        }
        $unit->created_by = auth()->user()->id;
        $unit->save(); 
        return response()->json(['id'=>$unit->id,'name'=>$unit->unit,'addto'=>'unit_append','modal'=>'unit_modal']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'unit'=>'required',
            'child_unit'=>'nullable',
            'convert_rate'=>'nullable|numeric',
        ]);

        $unit = new Unit;
        $unit->unit =$request->unit;
        if ($request->check==1) {
          $unit->child_unit =$request->child_unit;
          $unit->convert_rate =$request->convert_rate;
        }
        $unit->created_by = auth()->user()->id;
        $unit->save();

     return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Information Created')]);
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
        $model =Unit::find($id);
        return view('admin.production.unit.form',compact('model'));
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
      $validator = $request->validate([
            'unit'=>'required',
            'child_unit'=>'nullable',
            'convert_rate'=>'nullable|numeric',
        ]);

        $unit = Unit::find($id);
        $unit->unit =$request->unit;
        if ($request->check==1) {
          $unit->child_unit =$request->child_unit;
          $unit->convert_rate =$request->convert_rate;
        }
        $unit->updated_by = auth()->user()->id;
        $unit->save();

     return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Information Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $unit= Unit::find($id);
        $unit->delete();
        if ($unit) {
            return response()->json(['success' => true, 'status' => 'success', 'message' => 'Information Delete Successfully.']);
        }
    }
}
