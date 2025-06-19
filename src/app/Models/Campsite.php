<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campsite extends Model
{
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
