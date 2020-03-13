<?php

namespace App\Http\Controllers\Admin\Production;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\employee\Employee;
use App\models\Production\Product;
use App\models\Production\ProductMaterial;
use App\models\Production\Purchase;
use App\models\Production\RawMaterial;
use App\models\Production\Transaction;
use App\models\Production\TransactionPayment;
use App\models\Production\WorkOrder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.production.purchase.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = Transaction::all();
            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('purchase_by', function ($document) {
                    return $document->employee->name;
                })
                ->editColumn('brand_id', function ($document) {
                    return $document->brand->name;
                })
                ->editColumn('status', function ($document) {
                    if ($document->status == 'Received') {
                        return '<span class="badge badge-success">' . 'Received' . '</span>';
                    } else if($document->status == 'Pending') {
                        return '<span class="badge badge-warning">' . 'Pending' . '</span>';
                    } else if($document->status == 'Ordered') {
                        return '<span class="badge badge-info">' . 'Ordered' . '</span>';
                    }
                })
                ->editColumn('payment_status', function ($document) {
                    if ($document->payment_status == 'Paid') {
                        return '<span class="badge badge-success">' . 'Paid' . '</span>';
                    } else if($document->payment_status == 'Partial') {
                        return '<span class="badge badge-info">' . 'Partial' . '</span>';
                    } else if($document->payment_status == 'Due') {
                        return '<span class="badge badge-info">' . 'Due' . '</span>';
                    }
                })
                ->addColumn('action', function ($model) {
                    return view('admin.production.purchase.action', compact('model'));
                })->rawColumns(['action','status', 'payment_status'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function request()
    {
        return view('admin.production.purchase.request_prev');
    }

    public function create(Request $request)
    {
        $type = $request->type;
        $models = Employee::all();
        $workorders = WorkOrder::where('status', '=', 'requisition')->get();
        return view('admin.production.purchase.create', compact('models', 'workorders','type'));
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
            'purchase_by' => 'required',
        ]);

        $invoice_no = $request->invoice_no;
        $wo_id = $request->wo_id;

        $brand_id = '';
        if ($wo_id) {
            $brand = WorkOrder::findOrFail($wo_id);
            $brand_id = $brand->brand_id;
        }

        if ($request->payment == 0) {
            $type = 'Due';
        } else if($request->payment_due_hidden > 0){
            $type = 'Partial';
        }else{
            $type = 'Paid';
        }

        $model = new Transaction;
        $model->purchase_by = $request->purchase_by;
        $model->reference_no = $request->reference_no;
        $model->invoice_no = $invoice_no;
        $model->date = $request->purchase_date;
        $model->type = 'debit';
        $model->transaction_type = 'Purchase';
        $model->work_order_id = $wo_id;
        $model->brand_id = $brand_id;
        $model->status = $request->status;
        $model->sub_total = $request->total_before_tax;
        $model->discount = $request->discount_amount;
        $model->discount_type = $request->discount_type;
        $model->discount_amount = $request->total_discount_amount;
        $model->net_total = $request->final_total;
        $model->paid = $request->payment;
        $model->due = $request->payment_due_hidden;
        $model->payment_status = $type;
        $model->stuff_note = $request->stuff_notes;
        $model->sell_note = $request->sell_notes;
        $model->transaction_note = $request->transaction_notes;
        $model->tek_marks = 0;
        $model->created_by = Auth::user()->id;
        $model->save();
        $id = $model->id;

        if ($request->wo_id) {
           $workorders = WorkOrder::findOrFail($request->wo_id);
           $workorders->transaction_status = 'transaction';
           $workorders->save();
        }

        for ($i = 0; $i < count($request->raw_material); $i++) {
            $purchase = new Purchase;
            $purchase->transaction_id = $id;
            $purchase->raw_material_id = $request->raw_material[$i];
            $purchase->qty = $request->qty[$i];
            $purchase->return_qty = '';
            $purchase->price = $request->unit_price[$i];
            $purchase->unit_id = $request->unit_id[$i];
            $purchase->line_total = $request->price[$i];
            $purchase->created_by = auth()->user()->id;
            $purchase->save();
        }


        if ($request->payment) {
            $payment = new TransactionPayment;
            $payment->transaction_id = $id;
            $payment->method = $request->method;
            $payment->payment_date = $request->purchase_date;
            $payment->transaction_no = $request->transaction_no;
            $payment->amount = $request->payment;
            $payment->note = $request->payment_note;
            $payment->type = $type;
            $payment->created_by = auth()->user()->id;
            $payment->save();
        }

        // Activity Log
        activity()->log('Created a Purchase - ' . Auth::user()->id);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data created Successfuly')]);
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

    public function details($id)
    {
        $model = Transaction::findOrFail($id);
        return view('admin.production.purchase.details', compact('model'));
    }

    public function payment($id)
    {
        $model = Transaction::findOrFail($id);
        return view('admin.production.purchase.payment', compact('model'));
    }

    public function add_payment(Request $request, $id)
    {
        if ($request->due_amount > 0) {
            $type = 'Partial';
        }else if($request->due_amount == 0){
            $type = 'Paid';
        }

        $payment = new TransactionPayment;
        $payment->transaction_id = $id;
        $payment->method = $request->method;
        $payment->payment_date = $request->payment_date;
        $payment->transaction_no = $request->transaction_no;
        $payment->amount = $request->paid_amount;
        $payment->note = $request->payment_note;
        $payment->type = $type;
        $payment->created_by = auth()->user()->id;
        $payment->save();

        $transaction = Transaction::findOrFail($id);
        $new_paid = $transaction->paid + $request->paid_amount;
        $transaction->paid = $new_paid;
        $transaction->payment_status = $type;
        $transaction->due = $request->due_amount;
        $transaction->save();

        // Activity Log
        activity()->log('Add Payment - ' . Auth::user()->id);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Update Successfuly')]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Transaction::where('wo_id', $id)->delete();
        $type = TransactionPayment::where('transaction_id', $id)->delete();
        $type = Purchase::where('transaction_id', $id)->delete();
    }


    public function getEmployee()
    {
        $people = [];
        $data = [];

        $people = Employee::select('id')
            ->where('name', 'like', '%' . $_GET['term'] . '%')
            ->orWhere('contact_number', 'like', '%' . $_GET['term'] . '%')
            ->orWhere('email', 'like', '%' . $_GET['term'] . '%')
            ->orWhere('code', 'like', '%' . $_GET['term'] . '%')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($people as $k => $v) {
            $data[$k]['id'] = $v->id;
            $data[$k]['name'] = $this->getCatagoryParent($v->id);
        }
        return response()->json(['items' => $data]);
    }

    public function getCatagoryParent($id, $name = Null)
    {
        $category = Employee::find($id);
        if ($category) {
            $name =  $category->name;
        }
        return $name;
    }



    public function WorkOrder()
    {
        $people = [];
        $data = [];

        $people = WorkOrder::select('id')
            ->where('type', 'like', '%' . $_GET['term'] . '%')
            ->orWhere('code', 'like', '%' . $_GET['term'] . '%')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($people as $k => $v) {
            $data[$k]['id'] = $v->id;
            $data[$k]['code'] = $this->getWorkOrder($v->id);
        }
        return response()->json(['items' => $data]);
    }

    public function getWorkOrder($id, $code = Null)
    {
        $category = WorkOrder::find($id);
        if ($category) {
            $code =  $category->prefix .'-'. $category->code;
        }
        return $code;
    }


    //Get Product Material Serch
    public function getProduct()
    {
        $people = [];
        $data = [];

        $people = Product::select('id')
            ->where('name', 'like', '%' . $_GET['term'] . '%')
            ->orWhere('articel', 'like', '%' . $_GET['term'] . '%')
            ->orWhere('code', 'like', '%' . $_GET['term'] . '%')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($people as $k => $v) {
            $data[$k]['id'] = $v->id;
            $data[$k]['name'] = $this->Product_material($v->id);
        }
        return response()->json(['items' => $data]);
    }

    public function Product_material($id, $name = Null)
    {
        $category = Product::find($id);
        if ($category) {
            $name =  $category->name .'('. $category->articel.')';
        }
        return $name;
    }


    //Get Product Material Serch
    public function get_raw_material()
    {
        $people = [];
        $data = [];

        $people = RawMaterial::select('id')
            ->where('name', 'like', '%' . $_GET['term'] . '%')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($people as $k => $v) {
            $data[$k]['id'] = $v->id;
            $data[$k]['name'] = $this->raw_material($v->id);
        }
        return response()->json(['items' => $data]);
    }

    public function raw_material($id, $name = Null)
    {
        $category = RawMaterial::find($id);
        if ($category) {
            $name =  $category->name;
        }
        return $name;
    }
    

    public function rawMaterial(Request $request)
    {
        $item = RawMaterial::where('id', $request->id)->first();
        return view('admin.production.purchase.raw-material', compact('item'));
    }

    public function product(Request $request)
    {
        $models = WorkOrder::with('wop_material')->where('id', $request->id)->first();
        return view('admin.production.purchase.work-order', compact('models'));
    }

    public function material(Request $request)
    {
        $models = ProductMaterial::where('product_id', $request->id)->get();
        return view('admin.production.purchase.product-material', compact('models'));
    }
}
