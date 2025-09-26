<?php

namespace App\Console\Commands\LiteAPI;

use App\Models\Hotels\Country;
use App\Models\Hotels\Hotel;
use App\Services\LiteAPI\LiteAPI;
use Illuminate\Console\Command;

class FetchHotels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'liteapi:fetch-hotels';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get static data for hotels';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching hotels from each country...');

        $liteAPI = new LiteAPI;

        $countries = Country::pluck('code');

        foreach ($countries as $key => $code) {
            $this->info("➡ Country: $code");

            try {
                $rc = $liteAPI->getHotels($code);

                $hotelsToSave = [];

                foreach ($rc['data'] as $hotel) {
                    $hotelsToSave[] = [
                        'lite_id' => $hotel['id'],
                        'name' => $hotel['name'],
                        'description' => $hotel['hotelDescription'],
                        'main_photo' => $hotel['main_photo'],
                        'thumbnail' => $hotel['thumbnail'] ?? '',
                        'latitude' => $hotel['latitude'],
                        'longitude' => $hotel['longitude'],
                        'address' => $hotel['address'],
                        'zip' => $hotel['zip'],
                        'stars' => $hotel['stars'],
                        'rating' => $hotel['rating'],
                        'reviewCount' => $hotel['reviewCount'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                Hotel::upsert($hotelsToSave, ['lite_id'], [
                    'name', 'description', 'main_photo', 'thumbnail',
                    'latitude', 'longitude', 'address', 'zip',
                    'stars', 'rating', 'reviewCount', 'updated_at',
                ]);

                $this->info("✔ Imported " . count($hotelsToSave) . " hotels for $code");

            } catch (\Throwable $th) {
                $this->error($th->getMessage());
            }
        }

    }
}
