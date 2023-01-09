<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Auth;
use DataTables;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use View;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show product list
    public function index()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $warehouses = DB::table('warehouses')->get();
        return view('admin.product.index', compact('categories', 'brands', 'warehouses'));
    }

    // product data loaded by yajra datatable
    function list(Request $request) {
        if ($request->ajax()) {

            $category_id = $request->category_id;
            $brand_id = $request->brand_id;
            $warehouse_id = $request->warehouse_id;
            $product_status = $request->product_status;

            $products = Product::when($category_id, function ($query) use ($category_id) {
                return $query->where('category_id', $category_id);
            })->when($brand_id, function ($query) use ($brand_id) {
                return $query->where('brand_id', $brand_id);
            })->when($warehouse_id, function ($query) use ($warehouse_id) {
                return $query->where('warehouse_id', $warehouse_id);
            })->when($product_status != null, function ($query) use ($product_status) {
                return $query->where('product_status', $product_status);
            })->get();

            return DataTables::of($products)
                ->addIndexColumn()
                ->editColumn('category_name', function ($row) {
                    return $row->category->category_name;
                })
                ->editColumn('subcategory_name', function ($row) {
                    return $row->subcategory->subcategory_name;
                })
                ->editColumn('brand_name', function ($row) {
                    return $row->brand->brand_name;
                })
                ->editColumn('product_featured', function ($row) {
                    $status_type = 'product_featured';
                    return View::make('admin.product.status_action', compact('status_type', 'row'));
                })
                ->editColumn('product_today_deal', function ($row) {
                    $status_type = 'product_today_deal';
                    return View::make('admin.product.status_action', compact('status_type', 'row'));
                })
                ->editColumn('product_status', function ($row) {
                    $status_type = 'product_status';
                    return View::make('admin.product.status_action', compact('status_type', 'row'));
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = View::make('admin.product.action', compact('row'));
                    return $actionBtn;
                })
                ->rawColumns(['action', 'category_name', 'subcategory_name', 'brand_name', 'product_featured', 'product_today_deal'])
                ->make(true);
        }
    }

    //product create page
    public function create()
    {
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $pickup_point = DB::table('pickup_point')->get();
        $warehouses = DB::table('warehouses')->get();
        return view('admin.product.create', compact('categories', 'brands', 'pickup_point', 'warehouses'));
    }

    //product store
    public function store(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'childcategory_id' => 'required|exists:childcategories,id',
            'brand_id' => 'required|exists:brands,id',
            'pickup_point_id' => 'required|exists:pickup_point,id',
            'product_name' => 'required|max:255',
            'product_code' => 'required|max:255',
            'product_unit' => 'required|min:1',
            'product_selling_price' => 'required|min:1',
            'product_description' => 'required',
            'product_thumbnail' => 'required|mimes:jpeg,jpg,png,gif|max:1000',
            'product_images.*' => 'mimes:jpeg,jpg,png,gif|max:1000',
            'product_color' => 'required',
            'warehouse_id' => 'exists:warehouses,id',
        ]);

        $request['category_id'] = Subcategory::where('id', $request->subcategory_id)->first()->category_id;

        $request['product_status'] = $request->has('product_status') ? 1 : 0;
        $request['product_featured'] = $request->has('product_featured') ? 1 : 0;
        $request['product_today_deal'] = $request->has('product_today_deal') ? 1 : 0;
        $request['product_slider'] = $request->has('product_slider') ? 1 : 0;
        $request['product_trendy'] = $request->has('product_trendy') ? 1 : 0;

        $photo_product_thumbnail_path = null;
        if ($request->hasFile('product_thumbnail')) {
            $photo_product_thumbnail_path = $this->productFileUpload(null, $request->product_thumbnail, 600, 600);
        }

        $photo_product_image_paths = array();
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $key => $image) {
                $upload_path = $this->productFileUpload(null, $image, 600, 600);
                array_push($photo_product_image_paths, $upload_path);
            }
        }

        Product::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'childcategory_id' => $request->childcategory_id,
            'brand_id' => $request->brand_id,
            'pickup_point_id' => $request->pickup_point_id,
            'admin_id' => Auth::user()->id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'product_slug' => Str::slug($request->product_name, '-'),
            'product_unit' => $request->product_unit,
            'product_tags' => $request->product_tags,
            'product_video' => $request->product_video,
            'product_purchase_price' => $request->product_purchase_price,
            'product_selling_price' => $request->product_selling_price,
            'product_discount_price' => $request->product_discount_price,
            'product_stock_quantity' => $request->product_stock_quantity,
            'product_description' => $request->product_description,
            'product_thumbnail' => $photo_product_thumbnail_path,
            'product_images' => json_encode($photo_product_image_paths),
            'product_featured' => $request->product_featured,
            'product_status' => $request->product_status,
            'product_today_deal' => $request->product_today_deal,
            'product_cash_on_delivery' => $request->product_cash_on_delivery,
            'product_color' => $request->product_color,
            'product_size' => $request->product_size,
            'product_slider' => $request->product_slider,
            'flash_deal_id' => $request->flash_deal_id,
            'warehouse_id' => $request->warehouse_id,
            'date' => date('d-m-Y'),
            'month' => date('F'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Product Added', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //product status change
    public function statusChange(Request $request)
    {
        Product::where('id', $request->id)->update([
            $request->type => 1 - $request->value,
        ]);
        return response()->json('Product Updated');
    }

    //product edit
    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $pickup_point = DB::table('pickup_point')->get();
        $warehouses = DB::table('warehouses')->get();
        $childcategories = DB::table('childcategories')->where('subcategory_id', $product->subcategory_id)->get();
        return view('admin.product.edit', compact('product', 'categories', 'childcategories', 'brands', 'pickup_point', 'warehouses'));
    }

    //product update

    public function update(Request $request, $id)
    {

    }

    //product delete
    public function destroy($id)
    {
        $product = Product::where('id', $id)->select('product_images', 'product_thumbnail')->first();

        if (File::exists($product->product_thumbnail)) {
            File::delete($product->product_thumbnail);
        }

        foreach (json_decode($product->product_images) as $file_path) {
            if (File::exists($file_path)) {
                File::delete($file_path);
            }
        }

        Product::destroy($id);
        return response()->json('Product Deleted');
    }

    protected function productFileUpload($file_path, $photo, $width, $height)
    {
        if ($file_path && File::exists($file_path)) {
            File::delete($file_path);
        }

        $photoname = uniqid() . '.' . $photo->getClientOriginalExtension();
        $photo_path = "public/files/product/" . $photoname;
        Image::make($photo)->resize($width, $height)->save($photo_path);

        return $photo_path;
    }
}
