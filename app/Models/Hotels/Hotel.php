<?php

namespace App\Models\Hotels;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hotels';

    protected $fillable = [
        'lite_id',
        'name',
        'description',
        'main_photo',
        'thumbnail',
        'latitude',
        'longitude',
        'address',
        'zip',
        'stars',
        'rating',
        'reviewCount',
        'country',
        'city',
        'price'
    ];
}
