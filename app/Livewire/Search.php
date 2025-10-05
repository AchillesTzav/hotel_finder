<?php

namespace App\Livewire;

use App\Jobs\ProcessHotels;
use App\Models\Hotels\City;
use App\Models\Hotels\Search as HotelSearch;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

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
        $cityName = $this->searchData['cityName'] ?? null;
        $checkin = $this->searchData['checkin'] ?? null;
        $checkout = $this->searchData['checkout'] ?? null;

        if (! $cityName || ! $checkin || ! $checkout || empty($this->searchData['rooms'])) {
            // you might want to throw an error or return
            return;
        }

        // Build occupancies
        $occupancies = [];
        foreach ($this->searchData['rooms'] as $room) {
            $adults = 0;
            $children = [];

            $users = User::findMany($room);
            foreach ($users as $user) {
                $age = Carbon::parse($user->date_of_birth)->age;
                if ($age >= 18) {
                    $adults++;
                } else {
                    $children[] = $age;
                }
            }

            // Only include 'children' if there are children
            $roomData = ['adults' => $adults];
            if (! empty($children)) {
                $roomData['children'] = $children;
            }

            $occupancies[] = $roomData;
        }

        // Optional: save occupancy string to DB for reference
        $occupancy_string = implode('&', array_map(function ($room) {
            $str = $room['adults'];
            if (! empty($room['children'])) {
                $str .= '-' . implode(',', $room['children']);
            }

            return $str;
        }, $occupancies));

        //create search
        $hotelSearch = HotelSearch::create([
            'city' => $cityName,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'occupancy' => $occupancy_string,
        ]);

        $search_id = $hotelSearch->id;

        // Fetch city & country code
        $city = City::with('country')->where('name', $cityName)->first();
        $countryCode = $city->country->code ?? null;

        if (! $countryCode) {
            return;
        }

        //data to use in searchHotels and getMinHotelRates in ProccesHotels
        $search_data = [
            'occupancies' => $occupancies,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'countryCode' =>  $countryCode,
            'cityName' => $cityName,
            'currency' => 'EUR',
        ];

        // job call
        ProcessHotels::dispatch($search_data);

        return redirect()->route('availability', ['search_id' => $search_id]);
    }
}
