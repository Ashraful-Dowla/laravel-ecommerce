<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use DataTables;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use View;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show brand list
    public function index()
    {
        return view('admin.category.brand.index');
    }

    // brand data loaded by yajra datatable
    function list(Request $request) {
        if ($request->ajax()) {
            $brands = DB::table('brands')->get();

            return DataTables::of($brands)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = View::make('admin.category.brand.action', compact('row'));
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    // brand store
    public function store(Request $request)
    {
        $request['brand_slug'] = Str::slug($request->brand_name, '-');
        $request->validate([
            'brand_name' => 'required|max:100',
            'brand_slug' => 'max:255|unique:brands',
            'brand_logo' => 'required|mimes:png,jpg,jpeg|max:10000',
            'front_page' => 'in:1,0',
        ]);

        //image
        $photo = $request->brand_logo;
        $photoname = $request->brand_slug . '.' . $photo->getClientOriginalExtension();
        // $photo->move('public/files/brand', $photoname);
        $photo_file_path = "public/files/brand/" . $photoname;
        Image::make($photo)->resize(240, 120)->save($photo_file_path);

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => $request->brand_slug,
            'brand_logo' => $photo_file_path,
            'front_page' => $request->front_page,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Brand Created', 'alert_type' => 'success');
        return back()->with($notification);

    }

    //brand edit
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.category.brand.edit', compact('brand'));
    }

    //brand update
    public function update(Request $request, $id)
    {
        $request['brand_slug'] = Str::slug($request->brand_name, '-');
        $request->validate([
            'brand_name' => 'required|max:100',
            'brand_slug' => 'max:255|unique:brands,brand_slug,' . $id,
            'brand_logo' => 'mimes:png,jpg,jpeg|max:10000',
            'front_page' => 'in:1,0',
        ]);

        $brand = Brand::where('id', $id)->first();

        $photo = $request->brand_logo;
        $photo_file_path = $brand->brand_logo;

        if ($photo) {
            if (File::exists($photo_file_path)) {
                File::delete($photo_file_path);
            }
            $photoname = $request->brand_slug . '.' . $photo->getClientOriginalExtension();
            $photo_file_path = "public/files/brand/" . $photoname;
            Image::make($photo)->resize(240, 120)->save($photo_file_path);
        }

        $brand->update([
            'brand_name' => $request->brand_name,
            'brand_slug' => $request->brand_slug,
            'brand_logo' => $photo_file_path,
            'front_page' => $request->front_page,
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Brand Updated', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //brand delete
    public function destroy($id)
    {
        $data = Brand::find($id);
        if (File::exists($data->brand_logo)) {
            File::delete($data->brand_logo);
        }

        $data->delete();
        $notification = array('message' => 'Brand Deleted', 'alert_type' => 'success');
        return back()->with($notification);
    }
}
