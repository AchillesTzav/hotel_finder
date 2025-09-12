<?php

namespace App\Models\Hotels;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $table = "searches";

    protected $fillable = [
        'city',
        'checkin',
        'checkout',
        'occupancy',
    ];
}
