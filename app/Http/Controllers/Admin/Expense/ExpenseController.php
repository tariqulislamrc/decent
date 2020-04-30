<?php

namespace App\Http\Controllers\admin\Expense;

use App\Http\Controllers\Controller;
use App\models\Expense\Expense;
use App\models\Expense\ExpenseCategory;
use App\models\account\AccountTransaction;
use App\models\account\InvestmentAccount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.expense.index');
    }


    public function datatable(Request $request){
       if ($request->ajax()) {
           $document = Expense::orderBy('id','desc')->get();
            return DataTables::of($document)
                ->addIndexColumn()
                 ->editColumn('date', function ($model) {
                  return formatDate($model->date);
                 })
                 ->editColumn('category', function ($model) {
                  return $model->category?$model->category->name:'';
                 })
                 ->editColumn('account', function ($model) {
                  return $model->investment?$model->investment->name:'';
                 })
                ->addColumn('action', function ($model) {
                    return view('admin.expense.action', compact('model'));
                })->rawColumns(['action','category','date','account'])->make(true);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =ExpenseCategory::all();
        $investment =InvestmentAccount::pluck('name', 'id');
        return view('admin.expense.form',compact('categories','investment'));
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
            'expense_category_id'=>'required|integer',
            'investment_account_id'=>'required|integer',
            'amount'=>'required|numeric',
        ]);

        $model =new Expense;
        $model->investment_account_id =$request->investment_account_id;
        $model->expense_category_id =$request->expense_category_id;
        $model->reson =$request->reson;
        $model->amount =$request->amount;
        $model->note =$request->note;
        $model->date =Carbon::parse(date('Y-m-d'))->format('Y-m-d H:i:s');
        $model->created_by = auth()->user()->id;
        $model->save();

        $account_transaction =new AccountTransaction;
        $account_transaction->amount =$request->amount;
        $account_transaction->investment_account_id=$request->investment_account_id;
        $account_transaction->expense_id=$model->id;
        $account_transaction->type='debit';
        $account_transaction->sub_type='expense';
        $account_transaction->operation_date=Carbon::parse(date('Y-m-d'))->format('Y-m-d H:i:s');
        $account_transaction->created_by = auth()->user()->id;
        $account_transaction->note =$request->note;
        $account_transaction->save();
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
        $model =Expense::find($id);
        return view('admin.expense.show',compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories =ExpenseCategory::all();
        $investment =InvestmentAccount::pluck('name', 'id');
        $model =Expense::find($id);
        return view('admin.expense.form',compact('categories','model','investment'));
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
            'expense_category_id'=>'required|integer',
            'investment_account_id'=>'required|integer',
            'amount'=>'required|numeric',
        ]);

        $model =Expense::find($id);
        $model->expense_category_id =$request->expense_category_id;
        $model->investment_account_id =$request->investment_account_id;
        $model->reson =$request->reson;
        $model->amount =$request->amount;
        $model->note =$request->note;
        $model->date =Carbon::parse(date('Y-m-d'))->format('Y-m-d H:i:s');
        $model->updated_by = auth()->user()->id;
        $model->save();

        $account_transaction =AccountTransaction::where('expense_id',$id)->first();
        $account_transaction->investment_account_id=$request->investment_account_id;
        $account_transaction->operation_date=Carbon::parse(date('Y-m-d'))->format('Y-m-d H:i:s');
        $account_transaction->amount =$request->amount;
        $account_transaction->created_by = auth()->user()->id;
        $account_transaction->note =$request->note;
        $account_transaction->save();
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
        $model =Expense::find($id)->delete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Information Delete')]);
    }
}
