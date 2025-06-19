<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ←これを追加！
use Illuminate\Database\Eloquent\Model;

class Campsite extends Model
{
    use HasFactory; // ←これを追加！

    protected $fillable = [
        'name',
        'address',
        'description',
        'facilities',
        'price',
        'image_url',
        'latitude',
        'longitude',
    ];
}

