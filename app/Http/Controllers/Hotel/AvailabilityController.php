<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AvailabilityController extends Controller
{
    public function availability(Request $request) {
        $cache_key = $request->route('key');
        $hotels = Cache::get($cache_key);

        return view('hotel.availability', [
            'hotels' => $hotels['hotels'],
        ]);
    }
}
