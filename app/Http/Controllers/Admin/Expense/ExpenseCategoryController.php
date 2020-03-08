<?php

namespace App\Http\Controllers\admin\Expense;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Expense\ExpenseCategory;
use Yajra\DataTables\Facades\DataTables;
class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.expense.category.index');
    }

       public function datatable(Request $request){
       if ($request->ajax()) {
           $document = ExpenseCategory::all();
            return DataTables::of($document)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return view('admin.expense.category.action', compact('model'));
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
        return view('admin.expense.category.form');
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
            'name'=>'required|max:250',
        ]);

        $category =new ExpenseCategory;
        $category->name =$request->name;
        $category->note =$request->note;
        $category->created_by = auth()->user()->id;
        $category->save();
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
        $model =ExpenseCategory::find($id);
        return view('admin.expense.category.form',compact('model'));
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
        $category =ExpenseCategory::find($id);
        $category->name =$request->name;
        $category->note =$request->note;
        $category->updated_by = auth()->user()->id;
        $category->save();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Information Update')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category =ExpenseCategory::find($id)->delete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Information Delete')]);
    }
}
