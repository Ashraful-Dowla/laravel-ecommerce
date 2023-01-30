<?php

namespace App\Models;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_category_id',
        'title',
        'slug',
        'published_date',
        'description',
        'thumbnail',
    ];

    public function blog_category()
    {
        return $this->belongsTo(BlogCategory::class);
    }
}
