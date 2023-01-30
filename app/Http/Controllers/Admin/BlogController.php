<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $blog_categories = BlogCategory::all();
        return view('admin.blog.category.index', compact('blog_categories'));
    }

    //blog category store
    public function store(Request $request)
    {
        $request['blog_category_slug'] = Str::slug($request->blog_category_name, '-');
        $request->validate([
            'blog_category_name' => 'required|max:100',
            'blog_category_slug' => 'unique:blog_categories|max:255',
        ]);

        BlogCategory::insert([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => $request->blog_category_slug,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Blog Category Inserted', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //blog category edit
    public function edit($id)
    {
        $data = BlogCategory::where('id', $id)->first();
        return response()->json($data);
    }

    //blog category update
    public function update(Request $request)
    {
        $request['blog_category_slug'] = Str::slug($request->blog_category_name, '-');
        $request->validate([
            'blog_category_name' => 'required|max:100',
            'blog_category_slug' => 'max:255|unique:blog_categories,blog_category_slug,' . $request->id,
        ]);

        BlogCategory::where('id', $request->id)->update([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => $request->blog_category_slug,
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Blog Category Updated', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //blog category delete
    public function destroy($id)
    {
        BlogCategory::where('id', $id)->delete();
        $notification = array('message' => 'Blog Category Deleted', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //blog
    public function blog_index()
    {
        return view('admin.blog.index');
    }

    // blog data loaded by yajra datatable
    function list(Request $request) {
        if ($request->ajax()) {
            $blogs = Blog::all();

            return DataTables::of($blogs)
                ->addIndexColumn()
                ->editColumn('blog_category_name', function ($row) {
                    return $row->blog_category->blog_category_name;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = View::make('admin.category.brand.action', compact('row'));
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
