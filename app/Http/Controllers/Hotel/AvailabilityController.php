<?php

namespace App\Http\Controllers\Hotel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function availability(Request $request) {
        $search_id = $request->route('search_id');

        return view('hotel.availability', [
            'search_id' => $search_id,
        ]);
    }
}
