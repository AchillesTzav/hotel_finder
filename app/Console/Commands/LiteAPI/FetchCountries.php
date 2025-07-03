<?php

namespace App\Console\Commands\LiteAPI;

use App\Models\Hotels\Country;
use Illuminate\Console\Command;
use App\Services\LiteAPI\LiteAPI;
use Illuminate\Support\Facades\Log;

class FetchCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-countries';

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
        $this->info('Fetching countries from LiteAPI...');

        try {
            $liteAPI = new LiteAPI();

            $countries = $liteAPI->getCountries();

            $this->info('Countries fetched: ' . count($countries['data']));

            // Prepare data
            $data = array_map(function ($country) {
                return [
                    'code' => $country['code'],
                    'name' => $country['name'],
                ];
            }, $countries['data']);

            $this->info('Saving countries to the database...');

            // Optional: show a progress bar
            $bar = $this->output->createProgressBar(count($data));
            $bar->start();

            foreach ($data as $country) {
                Country::updateOrCreate(
                    ['code' => $country['code']],
                    ['name' => $country['name']]
                );
                $bar->advance();
            }

            $bar->finish();
            $this->newLine();
            $this->info('Done: Countries saved to the database.');
        } catch (\Throwable $th) {
            $this->error('Error: ' . $th->getMessage());
            Log::error('error fetching countries: ' . $th->getMessage(), [
                'exception' => $th
            ]);
        }
    }
}
