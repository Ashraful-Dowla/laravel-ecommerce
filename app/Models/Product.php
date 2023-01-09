<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Pickuppoint;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\HasFactory
;use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'childcategory_id',
        'brand_id',
        'pickup_point_id',
        'admin_id',
        'product_name',
        'product_code',
        'product_unit',
        'product_tags',
        'product_video',
        'product_purchase_price',
        'product_selling_price',
        'product_discount_price',
        'product_stock_quantity',
        'product_description',
        'product_thumbnail',
        'product_images',
        'product_featured',
        'product_status',
        'product_today_deal',
        'product_cash_on_delivery',
        'product_color',
        'product_size',
        'product_views',
        'product_trendy',
        'flash_deal_id',
        'warehouse_id',
        'product_slug',
        'date',
        'month',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function childcategory()
    {
        return $this->belongsTo(Childcategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function pickuppoint()
    {
        return $this->belongsTo(Pickuppoint::class, 'pickup_point_id');
    }

}
