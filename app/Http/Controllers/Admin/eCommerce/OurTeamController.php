<?php

namespace App\Http\Controllers\Admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\OurTeam;
use Yajra\DataTables\DataTables;

class OurTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('admin.eCommerce.our_team.index');
    }


     public function datatable(Request $request){
       if ($request->ajax()) {
            $document = OurTeam::where('team_name', '!=', config('system.default_role.admin'))->get();
            return DataTables::of($document)
                ->addIndexColumn()
                ->addColumn('action', function ($model) {
                    return view('admin.eCommerce.our_team.action', compact('model'));
                })->rawColumns(['action'])->make(true);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.eCommerce.our_team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $data = $request->validate([
            'team_name' => 'required',
            'team_designation' => 'required',
            'image_one' => 'required',
            'image_two' => 'required',
            'description' => 'required',
        ]);

         if ($request->hasFile('image_one')) {
            $storagepath = $request->file('image_one')->store('public/eCommerce/about');
            $fileName = basename($storagepath);
            $data['image_one'] = $fileName;
        }else{
            $data['image_one'] = $nodels->image_one;
        }

         if ($request->hasFile('image_two')) {
            $storagepath = $request->file('image_two')->store('public/eCommerce/about');
            $fileName = basename($storagepath);
            $data['image_two'] = $fileName;
        }else{
            $data['image_two'] = $nodels->image_one;
        }
        $model = new OurTeam;
        $model->create($data);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'goto' => route('admin.eCommerce.our-team.index')]);
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
