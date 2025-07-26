<?php

namespace App\Models\Hotels;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hotels\City;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'code',
        'name',
    ];

    public function cities() {
        return $this->hasMany(City::class);
    }
}
