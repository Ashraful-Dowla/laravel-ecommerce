<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // show category list
    public function index()
    {
        $categories = DB::table('categories')->get();
        // $categories = Category::all();
        return view('admin.category.category.index', compact('categories'));
    }

    //category store
    public function store(Request $request)
    {
        $request['category_slug'] = Str::slug($request->category_name, '-');
        $request->validate([
            'category_name' => 'required|max:100',
            'category_slug' => 'unique:categories|max:255',
            'category_icon' => 'required',
        ]);

        $photo_category_path = null;
        if ($request->hasFile('category_icon')) {
            $photo_category_path = $this->categoryFileUpload(null, $request->category_icon, 32, 32);
        }

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
            'category_icon' => $photo_category_path,
            'category_home_page' => $request->category_home_page,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Category Inserted', 'alert_type' => 'success');
        return back()->with($notification);
    }

    // get category by id
    public function edit($id)
    {
        // $data = DB::table('categories')->where('id',$id)->first();
        $data = Category::findOrFail($id);
        return response()->json($data);
    }

    //category update
    public function update(Request $request)
    {
        $request['category_slug'] = Str::slug($request->category_name, '-');
        $request->validate([
            'category_name' => 'required|max:100',
            'category_slug' => 'max:255|unique:categories,category_slug,' . $request->id,
        ]);

        // DB::table('categories')->where('id', $request->id)->update([
        //     'category_name' => $request->category_name,
        //     'category_slug' => $request->category_slug,
        //     'updated_at' => now(),
        // ]);

        $category = Category::where('id', $request->id)->first();

        $photo_category_path = $category->category_icon;
        if ($request->hasFile('category_icon')) {
            $photo_category_path = $this->categoryFileUpload($photo_category_path, $request->category_icon, 32, 32);
        }

        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
            'category_icon' => $photo_category_path,
            'category_home_page' => $request->category_home_page,
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Category Updated', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //category delete
    public function destroy($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        // Category::destroy($id);

        $notification = array('message' => 'Category Deleted', 'alert_type' => 'success');
        return back()->with($notification);
    }

    protected function categoryFileUpload($file_path, $photo, $width, $height)
    {
        if ($file_path && File::exists($file_path)) {
            File::delete($file_path);
        }

        $photoname = uniqid() . '.' . $photo->getClientOriginalExtension();
        $photo_path = "public/files/category/" . $photoname;
        Image::make($photo)->resize($width, $height)->save($photo_path);

        return $photo_path;
    }

}
