<?php

namespace App\Livewire;

use App\Models\Hotels\City;
use App\Models\Hotels\Search as HotelSearch;
use App\Models\User;
use App\Services\LiteAPI\LiteAPI;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Jobs\ProcessHotels;

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

        $occupancies = [];

        foreach ($this->searchData['rooms'] as $room) {
            $adults = 0;
            $children = [];

            // collection of users inside the room
            $users = User::findMany($room);

            foreach ($users as $user) {
                $age = Carbon::parse($user->date_of_birth)->age;
                if ($age >= 18) {
                    $adults++;
                } else {
                    $children[] = $age;
                }
            }

            // Add room occupancy to the array
            $occupancies[] = [
                'adults' => $adults,
                'children' => $children,
            ];

            $occupancy_string = implode('&', array_map(function ($room) {
                $str = $room['adults'];
                if (count($room['children']) > 0) {
                    $str .= '-'.implode(',', $room['children']);
                }

                return $str;
            }, $occupancies));
        }

        $hotelSearch = HotelSearch::create([
            'city' => $cityName,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'occupancy' => $occupancy_string,
        ]);

        $search_id = $hotelSearch->id;


        $city = City::with('country')->where('name', $cityName)->first();
        $countryCode = $city->country->code;

        //"occupancies":[{"adults":2},{"adults":1}]}'
        // 3&1
        $occupancy_arr = explode("&", $occupancy_string);

        $occupancy_object = [];
        foreach ($occupancy_arr as $room) {
            $occupancy_object[] = [
                ['adults' => $room]
            ];
        }

        $occupancy_json = json_encode($occupancy_object); 
        

        $search_params = [
            'city' => $cityName,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'occupancy' => $occupancy_json,
        ];

        if (! $countryCode || ! $cityName) {
            return;
        }

        $liteAPI = new LiteAPI;

        $rc = $liteAPI->searchHotels($countryCode, $cityName);

        /**
         * @todo job batching if suppliers > 1
         */
        ProcessHotels::dispatch($rc['data']);
        
        /**
         * @todo add search id to request
         */
        return redirect()->route('availability', ['search_id' => $search_id]);
    }

    
}
