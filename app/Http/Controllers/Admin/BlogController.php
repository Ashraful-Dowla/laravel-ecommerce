<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
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
        $blog_categories = DB::table('blog_categories')->get();
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

        DB::table('blog_categories')->insert([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => $request->blog_category_slug,
        ]);

        $notification = array('message' => 'Blog Category Inserted', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //blog category edit
    public function edit($id)
    {
        $data = DB::table('blog_categories')->where('id', $id)->first();
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

        DB::table('blog_categories')->where('id', $request->id)->update([
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
         DB::table('blog_categories')->where('id', $id)->delete();
         $notification = array('message' => 'Blog Category Deleted', 'alert_type' => 'success');
         return back()->with($notification);
     }
}
