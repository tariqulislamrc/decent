<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\models\email\EmailTemolate;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.client.index');
    }

    public function datatable(Request $request){
       if ($request->ajax()) {
            $document = Client::all();
            return DataTables::of($document)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return view('admin.client.action', compact('model'));
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
        return view('admin.client.form');
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
            'mobile'=>'required',
            'email'=>'nullable|email',
            'net_total'=>'nullable|numeric',
        ]);

         $input = $request->only(['type',
                'name', 'mobile', 'landline', 'alternate_number', 'city', 'state', 'country', 'landmark', 'email']);
         $input['created_by'] = auth()->user()->id;
         $contact = Client::create($input);


     return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Information Created')]);
    }

    public function quick_add(Request $request)
    {
        $validator = $request->validate([
            'name'=>'required',
            'mobile'=>'required',
            'email'=>'nullable|email',
            'net_total'=>'nullable|numeric',
        ]);

         $input = $request->only(['type',
                'name', 'mobile', 'landline', 'alternate_number', 'city', 'state', 'country', 'landmark', 'email']);
         $input['created_by'] = auth()->user()->id;
         $contact = Client::create($input);
         return response()->json(['id'=>$contact->id,'name'=>$contact->name,'addto'=>'customer_id','modal'=>'contact_modal']);
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
      $model =Client::find($id);
       return view('admin.client.form',compact('model'));
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
            'mobile'=>'required',
            'email'=>'nullable|email',
            'net_total'=>'nullable|numeric',
        ]);

         $input = $request->only(['type',
                'name', 'mobile', 'landline', 'alternate_number', 'city', 'state', 'country', 'landmark', 'email']);
         $input['updated_by'] = auth()->user()->id;
         $contact =Client::find($id);
         $contact->update($input);

         
     return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Information Updated')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $model= Client::find($id);
        $model->delete();
        if ($model) {
            return response()->json(['success' => true, 'status' => 'success', 'message' => 'Information Delete Successfully.']);
        }

    }

    public function email($id)
    {
        $model =Client::find($id);
        $templates = EmailTemolate::pluck('name','id');
        return view('admin.client.mail',compact('model','templates'));
    }

    public function sms($id)
    {
        $model =Client::find($id);
        return view('admin.client.sms',compact('model'));
    }

   public function customers()
    {
        if (request()->ajax()) {
            $term = request()->input('q', '');

            $contacts = Client::query();

            if (!empty($term)) {
                $contacts->where(function ($query) use ($term) {
                    $query->where('name', 'like', '%' . $term .'%')
                            ->orWhere('mobile', 'like', '%' . $term .'%');
                });
            }

            $contacts = $contacts->select(
                'id',
                'name as text',
                'mobile',
                'landmark',
                'city',
                'state',
            )
                    ->get();

            return json_encode($contacts);
        }
    }
}



