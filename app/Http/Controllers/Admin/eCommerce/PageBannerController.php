<?php

namespace App\Http\Controllers\Admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\PageBanner;
use Yajra\DataTables\Facades\DataTables;

class PageBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.eCommerce.page-banner.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = PageBanner::get();
            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('image', function ($model) {
                    $url = asset('storage/page/' . $model->image);
                    return '<img src="' . $url . '" border="0" width="90" height="60" class="img-rounded" align="center" />';
                })
                ->addColumn('action', function ($model) {
                    return view('admin.eCommerce.page-banner.action', compact('model'));
                })->rawColumns(['action', 'image'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.eCommerce.page-banner.create');
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
            'page_name' => 'required',
            'image' => 'mimes:jpeg,jpg,png | max:2000',
        ]);

        $page = new PageBanner;

        if ($request->hasFile('image')) {
            $storagepath = $request->file('image')->store('public/page');
            $fileName = basename($storagepath);
            $page->image = $fileName;
        } else {
            $page->image = '';
        }

        $page->page_name = $request->page_name;
        $page->save();

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'goto' => route('admin.eCommerce.page-banner.index')]);

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
        $type = PageBanner::findOrFail($id);
        $type->delete();
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully'), 'load' => true]);
    }
}
