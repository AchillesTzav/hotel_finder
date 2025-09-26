<?php

namespace App\Jobs;

use App\Models\Hotels\Hotel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

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
        $hotels_to_save = [];

        foreach ($this->data as $hotel) {
            $hotels_to_save[] = [
                'lite_id' => $hotel['id'] ?? '',
                'name' => $hotel['name'] ?? '',
                'description' => $hotel['hotelDescription'] ?? '',
                'main_photo' => $hotel['main_photo'] ?? '',
                'thumbnail' => $hotel['thumbnail'] ?? '',
                'latitude' => $hotel['latitude'] ?? '',
                'longitude' => $hotel['longitude'] ?? '',
                'address' => $hotel['address'] ?? '',
                'zip' => $hotel['zip'] ?? '',
                'stars' => $hotel['stars'] ?? '',
                'rating' => $hotel['rating'] ?? '',
                'reviewCount' => $hotel['reviewCount'] ?? '',
                'country' => $hotel['country'] ?? '',
                'city' => $hotel['city'] ?? '',
            ];
        }

        Hotel::upsert(
        $hotels_to_save,
        ['lite_id'],
        ['name', 'description', 'main_photo', 'thumbnail', 'latitude', 'longitude', 'address', 'zip', 'stars', 'rating', 'reviewCount', 'country', 'city'] // Columns to update
        );
    }
}
