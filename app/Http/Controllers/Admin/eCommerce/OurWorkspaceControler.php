<?php

namespace App\Http\Controllers\admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\OurWorkspace;

class OurWorkspaceControler extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.eCommerce.our_workspace.index');
    }


     public function datatable(Request $request){
       if ($request->ajax()) {
            $document = OurWorkspace::where('team_name', '!=', config('system.default_role.admin'))->get();
            return DataTables::of($document)
                ->addIndexColumn()
                
                 ->editColumn('image_one',function($model){
                $url= asset('storage/eCommerce/about/'.$model->image_one);
                return '<img src="'.$url.'" border="0" width="120" height="50" class="img-rounded" align="center" />';
                   })
                ->editColumn('image_two',function($model){
                $url= asset('storage/eCommerce/about/'.$model->image_two);
                return '<img src="'.$url.'" border="0" width="120" height="50" class="img-rounded" align="center" />';
                   })
                ->addColumn('action', function ($model) {
                    return view('admin.eCommerce.our_team.action', compact('model'));
                })->rawColumns(['action','image_one','image_two'])->make(true);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.eCommerce.our_workspace.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data = $request->validate([
            'image_one' => 'required',
            'image_one_alt' => '',
            'image_two' => 'required',
            'image_two_alt' => '',
            'image_three' => 'required',
            'image_three_alt' => '',
            'image_four' => 'required',
            'image_four_alt' => '',
        ]);

         if ($request->hasFile('image_one')) {
            $storagepath = $request->file('image_one')->store('public/eCommerce/about');
            $fileName = basename($storagepath);
            $data['image_one'] = $fileName;
        }else{
            $data['image_one'] = '';
        }

         if ($request->hasFile('image_two')) {
            $storagepath = $request->file('image_two')->store('public/eCommerce/about');
            $fileName = basename($storagepath);
            $data['image_two'] = $fileName;
        }else{
            $data['image_two'] = '';
        }

        if ($request->hasFile('image_three')) {
            $storagepath = $request->file('image_three')->store('public/eCommerce/about');
            $fileName = basename($storagepath);
            $data['image_three'] = $fileName;
        }else{
            $data['image_three'] = '';
        }

        if ($request->hasFile('image_four')) {
            $storagepath = $request->file('image_four')->store('public/eCommerce/about');
            $fileName = basename($storagepath);
            $data['image_four'] = $fileName;
        }else{
            $data['image_four'] = '';
        }

        $model = new OurWorkspace;
        $model->create($data);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'goto' => route('admin.eCommerce.our-workspace.index')]);
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
        //
    }
}
