<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\models\Production\IngredientsCategory;
use App\models\depertment\Depertment;
use App\models\depertment\DepertmentEmployee;
use App\models\depertment\DepertmentIgCategory;
use App\models\depertment\DepertmentStore;
use App\models\employee\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\DataTables;

class DepertmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.depertment.index');
    }


     public function datatable(Request $request){
       if ($request->ajax()) {
            $document = Depertment::orderBy('id','DESC')->get();
            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('head',function($model){
                   return $model->employee->name;
                   })
                ->addColumn('action', function ($model) {
                    return view('admin.depertment.action', compact('model'));
                })->rawColumns(['head','action'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employee = Employee::pluck('name','id');
        return view('admin.depertment.form',compact('employee'));
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
            'name'=>'required',
            'employee_id'=>'required|integer',
        ]);

        $model =new Depertment;
        $model->name =$request->name;
        $model->employee_id=$request->employee_id;
        $model->description=$request->description;
        $model->hidden = 0;
        $model->tek_marks = 0;
        $model->created_by = auth()->user()->id;
        $model->save();
        //depertment employee
        $d_emp =new DepertmentEmployee;
        $d_emp->depertment_id=$model->id;
        $d_emp->employee_id=$request->employee_id;
        $d_emp->designation='Head';
        $d_emp->save();
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
      $model =Depertment::findOrFail($id);
      return view('admin.depertment.show',compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model =Depertment::findOrFail($id);
        return view('admin.depertment.form',compact('model'));
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
            'name'=>'required',
        ]);

        $model =Depertment::findOrFail($id);
        $model->name =$request->name;
        $model->description=$request->description;
        $model->hidden = 0;
        $model->tek_marks = 0;
        $model->created_by = auth()->user()->id;
        $model->save();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Information Created')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model =Depertment::find($id)->forceDelete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Information Deleted')]);
    }


    public function new_employee($id)
    {
       $depert =Depertment::findOrFail($id);
       $employee_id=[];
       foreach ($depert->depertment_employee as  $value) {
           $employee_id[]=$value->employee_id;
       }
       $employee = Employee::whereNotIn('id',$employee_id)->pluck('name','id'); 
       return view('admin.depertment.new_employee',compact('employee','depert'));
    }

    public function new_employee_add(Request $request)
    {
        $validator = $request->validate([
            'employee_id'=>'required|integer',
        ]);

        $d_emp =new DepertmentEmployee;
        $d_emp->depertment_id=$request->depertment_id;
        $d_emp->employee_id=$request->employee_id;
        $d_emp->designation='Member';
        $d_emp->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('New Employee Add To the Depertment'),'load'=>true]);
    }

    public function employee_destroy($id)
    {
        $d_emp =DepertmentEmployee::findOrFail($id);
        if ($d_emp->designation=='Head') {
           throw ValidationException::withMessages(['message' => _lang('You Can not Remove Department Head')]);
        }

        $d_emp->forceDelete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Information Deleted'),'load'=>true]);
    }

    public function new_category($id)
    {
       $depert =Depertment::findOrFail($id);
       $category_id=[];
       foreach ($depert->igcategory as  $value) {
           $category_id[]=$value->ingredients_category_id;
       }
       $category = IngredientsCategory::whereNotIn('id',$category_id)->pluck('name','id'); 
       return view('admin.depertment.new_category',compact('category','depert'));
    }

    public function new_category_add(Request $request)
    {
        $validator = $request->validate([
            'ingredients_category_id'=>'required|integer',
        ]);

        $ing_category =new DepertmentIgCategory;
        $ing_category->depertment_id=$request->depertment_id;
        $ing_category->ingredients_category_id=$request->ingredients_category_id;
        $ing_category->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('New Category Add To the Depertment'),'load'=>true]);
    }

    public function category_destroy($id)
    {
        $ing_category =DepertmentIgCategory::findOrFail($id);
        $ing_category->forceDelete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Information Deleted'),'load'=>true]);
    }

    public function approve_request($id)
    {
        $model =DepertmentStore::findOrFail($id);
        return view('admin.depertment.approve_request',compact('model'));
    }
}
