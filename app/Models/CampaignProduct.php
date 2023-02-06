<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CampaignProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'product_id',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
