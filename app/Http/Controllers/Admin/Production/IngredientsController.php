<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\models\Production\IngredientsCategory;
use Yajra\Datatables\Datatables;
use Illuminate\Validation\Rule;
use Auth;

class IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.production.ingredients.index');
    }



    public function datatable(Request $request){
       if ($request->ajax()) {
            $document = IngredientsCategory::where('name', '!=', config('system.default_role.admin'))->get();
            return DataTables::of($document)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return view('admin.production.ingredients.action', compact('model'));
                })->rawColumns(['action'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.production.ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'name' => 'required|unique:ingredients_categories|max:255',
            'description' => '',
            'status' => '',
        ]);

        if ($request->status) {
            $status = 1;
        }else{
            $status = 0;
        }

        $model = new IngredientsCategory;
        $model->name = $request->name;
        $model->description = $request->description;
        $model->status = $status;
        $model->hidden = 0;
        $model->tek_marks = 0;
        $model->created_by = Auth::user()->id;
        $model->save();

        // Activity Log
        activity()->log('Created a Production Ingredients Category - ' . Auth::user()->id);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data created Successfuly'), 'load'=>true]);
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
    public function edit($id){
        $model = IngredientsCategory::findOrFail($id);
        return view('admin.production.ingredients.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $model =  IngredientsCategory::findOrFail($id);
         $request->validate([
            'name' => ['required',Rule::unique('ingredients_categories')->ignore($model->id)],
            'description' => '',
            'status' => '',
        ]);
        if ($request->status) {
            $status = 1;
        }else{
            $status = 0;
        }
        $model->name = $request->name;
        $model->description = $request->description;
        $model->status = $request->status;
        $model->hidden = 0;
        $model->tek_marks = 0;
        $model->updated_by = Auth::user()->id;
        $model->save();

        // Activity Log
        activity()->log('Update a Production Ingredients Category - ' . Auth::user()->id);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Update Successfuly'), 'load'=>true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $type = IngredientsCategory::findOrFail($id);
        $name = $type->name;
        $type->delete();
        activity()->log('Delete a Ingredients Category - ' . $name);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully'), 'load'=>true]);
    }
}
