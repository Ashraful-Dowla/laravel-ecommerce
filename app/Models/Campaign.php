<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_title',
        'campaign_start_date',
        'campaign_end_date',
        'campaign_image',
        'campaign_status',
        'campaign_discount',
        'campaign_month',
        'campaign_year',
    ];
}
