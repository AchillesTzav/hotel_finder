<?php

namespace App\Models\Hotels;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'code',
        'name',
    ];
}
