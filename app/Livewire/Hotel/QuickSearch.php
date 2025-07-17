<?php

namespace App\Livewire\Hotel;

use Livewire\Component;
use App\Models\Hotels\Country;
use App\Services\LiteAPI\LiteAPI;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class QuickSearch extends Component
{
    public $random_countries = [];


    public $country_code;

    public function mount()
    {
        $this->random_countries = $this->getRandomCountry();
    }

    public function getRandomCountry()
    {
        return Country::inRandomOrder()->limit(6)->get();
    }

    public function quickSearch($code)
    {

        $this->country_code = $code;
        $this->fetchHotels();
    }

    public function fetchHotels()
    {
        if (!$this->country_code) return;

        $liteAPI = new LiteAPI();

        $rc = $liteAPI->getHotels($this->country_code);

        $hotels = collect($rc['data'] ?? []);

        $cache_key = 'hotels_' . Str::uuid();

        // 🧠 Cache it for 5 minutes
        Cache::put($cache_key, [
            'hotels' => $hotels,
            //'country_code' => $this->country_code,
        ], now()->addMinutes(5));


        return redirect()->route('availability', ['key' => $cache_key]);
    }

    public function render()
    {
        return view('livewire.hotel.quick-search');
    }
}
