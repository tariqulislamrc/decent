<?php

namespace App\Http\Controllers\admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\ContactUs;
use Yajra\DataTables\DataTables;

class ContactMessageController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.eCommerce.contact_message.index');
    }


    public function datatable(Request $request){
       if ($request->ajax()) {
            $document = ContactUs::where('name', '!=', config('system.default_role.admin'))->get();
            return DataTables::of($document)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return view('admin.eCommerce.contact_message.action', compact('model'));
                })
                ->editColumn('status', function ($model) {
                    if ($model->level_status=='seen') {
                        return '<span class="badge badge-danger">Unseen</span>';
                    }else{
                        return '<span class="badge badge-success">Seen</span>';
                    }
                })
                ->rawColumns(['action','status'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
       return view('admin.eCommerce.contact_message.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = ContactUs::findOrFail($id);
        return view('admin.eCommerce.contact_message.show',compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $model = ContactUs::findOrFail($id);
        return view('admin.eCommerce.contact_message.replay',compact('model'));
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
    public function destroy($id){
        $type = ContactUs::findOrFail($id);
        $name = $type->name;
        $type->delete();
        activity()->log('Delete a contact Message - ' . $name);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Message Deleted Successfully'), 'load'=>true]);
    }
}
