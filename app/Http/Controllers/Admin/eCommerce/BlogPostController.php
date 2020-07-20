<?php

namespace App\Http\Controllers\Admin\eCommerce;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\eCommerce\BlogCategory;
use App\models\eCommerce\BlogPost;
use Yajra\DataTables\Facades\DataTables;
use Auth;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('ecommerce.view')) {
            abort(403, 'Unauthorized action.');
        }
        return view('admin.blog.post.index');
    }


    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = BlogPost::orderBy('id', 'DESC')->get();
            return DataTables::of($document)
                ->addIndexColumn()
                ->editColumn('category', function ($model) {
                    return $model->category->name;
                })
                ->editColumn('image', function ($model) {
                    $url = asset('storage/blog/' . $model->image);
                    return '<img src="' . $url . '" border="0" width="90" height="60" class="img-rounded" align="center" />';
                })
                ->editColumn('date', function ($model) {
                    return formatDate1($model->date);
                })
                ->editColumn('status', function ($model) {
                    if ($model->status == 'Active') {
                        return '<span class="badge badge-primary">Active</span>';
                    } else {
                        return '<span class="badge badge-warning">Inactive</span>';
                    }
                })
                ->addColumn('action', function ($model) {
                    return view('admin.blog.post.action', compact('model'));
                })->rawColumns(['category', 'image', 'date','status', 'action'])->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('ecommerce.view')) {
            abort(403, 'Unauthorized action.');
        }
        $models = BlogCategory::where('status', 'Active')->get();
        return view('admin.blog.post.create', compact('models'));
    }

    // make slug
    public function slug($old_slug, $row = Null)
    {
        if (!$row) {
            $slug = $old_slug;
            $row = 0;
        } else {
            $slug = $old_slug . '-' . $row;
        }

        $check_res = BlogPost::where('post_slug', $slug)->first();
        if ($check_res) {
            $slug = $this->slug($old_slug, $row + 1);
        }

        return $slug;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can('ecommerce.view')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'details' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);

        
        $model = new BlogPost;
        $slug = $this->slug(make_slug($request->title));

        if ($request->hasFile('photo')) {
            $storagepath = $request->file('photo')->store('public/blog');
            $fileName = basename($storagepath);
            $model->image = $fileName;
        } else {
            $model->image = '';
        }

        $model->post_slug = $slug;
        $model->blog_category_id = $request->category;
        $model->title = $request->title;
        $model->date = $request->date;
        $model->details = $request->details;
        $model->status = $request->status;
        $model->save();

        activity()->log('Created a Blog Post - ' . Auth::user()->id);
        return response()->json(['success' => true, 'load' => true, 'status' => 'success', 'message' => _lang('Data created Successfuly')]);

        // return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data created Successfuly')]);
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
        if (!auth()->user()->can('ecommerce.view')) {
            abort(403, 'Unauthorized action.');
        }
        $cate = BlogCategory::where('status', 'Active')->get();
        $model = BlogPost::findOrFail($id);
        return view('admin.blog.post.edit', compact('model', 'cate'));
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
        if (!auth()->user()->can('ecommerce.view')) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'category' => 'required',
            'title' => 'required',
            'details' => 'required',
            'date' => 'required',
            'status' => 'required',
        ]);

        $old_photo = '';
        $old_photo = $request->old_photo;

        $model = BlogPost::findOrFail($id);
        $slug = $this->slug(make_slug($request->title));

        if ($request->hasFile('photo')) {
            if ($model->image) {
                $image_path = public_path() . '/storage/blog/' . $model->image;
                unlink($image_path);
            }
            $storagepath = $request->file('photo')->store('public/blog');
            $fileName = basename($storagepath);
            $model->image = $fileName;
        } else {
            $model->image = $old_photo;
        }


        $model->post_slug = $slug;
        $model->blog_category_id = $request->category;
        $model->title = $request->title;
        $model->date = $request->date;
        $model->details = $request->details;
        $model->status = $request->status;
        $model->save();

        activity()->log('Update a Blog Post - ' . Auth::user()->id);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Update Successfuly')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can('ecommerce.view')) {
            abort(403, 'Unauthorized action.');
        }
        $type = BlogPost::findOrFail($id);
        $type->delete();

        activity()->log('Delete a Blog Post - ' . Auth::user()->id);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully')]);
    }
}