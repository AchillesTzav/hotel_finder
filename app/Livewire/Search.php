<?php

namespace App\Livewire;

use App\Models\Hotels\City;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Services\LiteAPI\LiteAPI;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class Search extends Component
{
    public $searchData = [];

    public function render()
    {
        return view('livewire.search');
    }

    #[On('addCityToSearch')]
    public function addCityToSearch($payload)
    {
        $this->searchData = array_merge($this->searchData, $payload);
    }

    #[On('addDatesToSearch')]
    public function addDatesToSearch($payload)
    {
        $this->searchData = array_merge($this->searchData, $payload);
    }

    #[On('addRoomsToSearch')]
    public function addRoomsToSearch($payload)
    {
        $this->searchData['rooms'] = $payload;
    }

    public function search()
    {
        $cityName = $this->searchData['cityName'];
        $checkin = $this->searchData['checkin'];
        $checkout = $this->searchData['checkout'];

        $city = City::with('country')->where('name', $cityName)->first();
        $countryCode = $city->country->code;

        if (!$countryCode || !$cityName) return;

        $liteAPI = new LiteAPI();

        $rc = $liteAPI->searchHotels($countryCode, $cityName);

        $hotels = collect($rc['data' ?? []]);

        file_put_contents('hotels.dat', print_r($hotels, true));

        $cache_key = 'search_' . Str::uuid();

        Cache::put($cache_key, [
            'hotels' => $hotels,
            //'country_code' => $this->country_code,
        ], now()->addMinutes(5));

        return redirect()->route('availability', ['key' => $cache_key]);
    }
}
