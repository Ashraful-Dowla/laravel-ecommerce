<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'image',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
