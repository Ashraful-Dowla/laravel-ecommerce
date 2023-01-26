<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'c_name',
        'c_phone',
        'c_phone_2',
        'c_email',
        'c_country',
        'c_city',
        'c_zipcode',
        'c_address',
        'c_address_2',
        'subtotal',
        'total',
        'coupon_code',
        'coupon_discount',
        'after_discount',
        'payment_type',
        'tax',
        'shipping_charge',
        'status',
        'date',
        'month',
        'year',
    ];
}
