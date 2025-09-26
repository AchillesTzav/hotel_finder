<?php

namespace App\Console\Commands\LiteAPI;

use Illuminate\Console\Command;
use App\Models\Hotels\City;
use App\Models\Hotels\Country;
use App\Services\LiteAPI\LiteAPI;
use Illuminate\Support\Facades\Log;

class FetchCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching cities for each country...');

        $liteAPI = new LiteAPI();
        $countries = Country::pluck('id', 'code');

        foreach ($countries as $code => $country_id) {
            $this->info("  Country: $code");

            try {
                $rc = $liteAPI->getCities($code);

                $cities = array_map(fn($city) => [
                    'name' => $city['city'],
                    'country_id' => $country_id, 
                ], $rc['data']);

                City::upsert($cities, ['country_id','name']);

                $this->info("Saved " . count($cities) . " cities for $code");

                sleep(1);
            } catch (\Throwable $e) {
                $this->error("Error for $code: " . $e->getMessage());
                Log::error("FetchCities error for $code", ['exception' => $e]);
                sleep(5);
            }
        }

        $this->info('🏁 All cities fetched and saved.');
    }
}
