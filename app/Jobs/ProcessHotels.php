<?php

namespace App\Jobs;

use App\Models\Hotels\Hotel;
use App\Services\LiteAPI\LiteAPI;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessHotels implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
        //deconstruct array
        [
            'occupancies' => $occupancies,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'countryCode' => $countryCode,
            'cityName' => $cityName,
            'currency' => $currency,
        ] = $this->data;

        // Prepare LiteAPI request
        $liteAPI = new LiteAPI;
        // search hotels
        $rc = $liteAPI->searchHotels($countryCode, $cityName);

        $hotelIds = $rc['hotelIds'];
        $hotels_to_save = [];
        $hotelPrices = [];


        foreach ($rc['data'] as $hotel) {
            $hotels_to_save[] = [
                'lite_id' => $hotel['id'] ?? '',
                'name' => $hotel['name'] ?? '',
                'description' => $hotel['hotelDescription'] ?? '',
                'main_photo' => $hotel['main_photo'] ?? '',
                'thumbnail' => $hotel['thumbnail'] ?? '',
                'latitude' => $hotel['latitude'] ?? 0,
                'longitude' => $hotel['longitude'] ?? 0,
                'address' => $hotel['address'] ?? '',
                'zip' => $hotel['zip'] ?? '',
                'stars' => $hotel['stars'] ?? '',
                'rating' => $hotel['rating'] ?? 0,
                'reviewCount' => $hotel['reviewCount'] ?? 0,
                'country' => $hotel['country'] ?? '',
                'city' => $hotel['city'] ?? '',
                'price' => null
            ];
        }

        Hotel::upsert(
            $hotels_to_save,
            ['lite_id'],
            ['name', 'description', 'main_photo', 'thumbnail', 'latitude', 'longitude', 'address', 'zip', 'stars', 'rating', 'reviewCount', 'country', 'city'] // Columns to update
        );

        $foo = [
            'hotelIds' => $hotelIds,
            'occupancies' => $occupancies,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'currency' => $currency,
            'guestNationality' => $countryCode,
        ];

        $bar = $liteAPI->getMinHotelRates($foo);

        foreach ($bar['data'] as $data) {
            $hotelPrices[] = [
                'lite_id' => $data['hotelId'],
                'price' => $data['price']
            ];
        }

        $hotelPrices = array_filter($hotelPrices, function ($item) use ($hotelIds) {
            return in_array($item['lite_id'], $hotelIds);
        });

        Hotel::upsert($hotelPrices, ['lite_id'], ['price']);
    }
}
