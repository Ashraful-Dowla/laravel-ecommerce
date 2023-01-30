<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use DataTables;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use View;

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
        $blog_categories = BlogCategory::all();
        return view('admin.blog.index', compact('blog_categories'));
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
                    $actionBtn = View::make('admin.blog.action', compact('row'));
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    //blog store
    public function blog_store(Request $request)
    {
        $request['slug'] = Str::slug($request->title, '-');
        $request->validate([
            'title' => 'required|max:100',
            'slug' => 'max:255',
            'thumbnail' => 'mimes:png,jpg,jpeg|max:10000',
            'description' => 'required',
            'status' => 'in:1,0',
        ]);

        // dd($request->all());

        //image
        $photo_file_path = null;
        if ($request->thumbnail) {
            $photo = $request->thumbnail;
            $photoname = $request->slug . '.' . $photo->getClientOriginalExtension();
            $photo_file_path = "public/files/blog/" . $photoname;
            Image::make($photo)->resize(240, 120)->save($photo_file_path);
        }

        Blog::insert([
            'blog_category_id' => $request->blog_category_id,
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'published_date' => $request->published_date,
            'tags' => $request->tags,
            'thumbnail' => $photo_file_path,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Blog Created', 'alert_type' => 'success');
        return back()->with($notification);
    }

    public function blog_edit($id)
    {
        $blog_categories = BlogCategory::all();
        $blog = Blog::where('id', $id)->first();
        return view('admin.blog.edit', compact('blog_categories', 'blog'));
    }

    public function blog_update(Request $request, $id)
    {
        $request['slug'] = Str::slug($request->title, '-');
        $request->validate([
            'title' => 'required|max:100',
            'slug' => 'max:255',
            'thumbnail' => 'mimes:png,jpg,jpeg|max:10000',
            'description' => 'required',
            'status' => 'in:1,0',
        ]);

        // dd($request->all());

        $blog = Blog::where('id', $id)->first();
        //image
        $photo_file_path = $blog->thumbnail;
        if ($request->thumbnail) {
            if (File::exists($photo_file_path)) {
                File::delete($photo_file_path);
            }
            $photo = $request->thumbnail;
            $photoname = $request->slug . '.' . $photo->getClientOriginalExtension();
            $photo_file_path = "public/files/blog/" . $photoname;
            Image::make($photo)->resize(240, 120)->save($photo_file_path);
        }

        Blog::where('id', $id)->update([
            'blog_category_id' => $request->blog_category_id,
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'published_date' => $request->published_date,
            'tags' => $request->tags,
            'thumbnail' => $photo_file_path,
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Blog Updated', 'alert_type' => 'success');
        return back()->with($notification);
    }

    public function blog_destroy($id)
    {
        $blog = Blog::where('id', $id)->first();
        if ($blog->thumbnail && File::exists($blog->thumbnail)) {
            File::delete($blog->thumbnail);
        }

        Blog::destroy($id);
        $notification = array('message' => 'Blog Deleted', 'alert_type' => 'success');
        return back()->with($notification);
    }
}
