<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

use Illuminate\Console\Command;
use App\Models\Hotels\Country;

class FetchFlags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-flags';

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
        $counties = Country::pluck('code');

        foreach ($counties as $country_code) {
            $code = strtolower($country_code);
            $url = "https://flagpedia.net/data/flags/w580/{$code}.webp";


            $response = Http::get($url); 
            
            if ($response->successful()) {
                Storage::disk('public')->put("flags/{$code}.webp", $response->body());
                $this->info("Flag with {$code} was saved.");
            } else {
                $this->warn("Failed to download flag: {$code}");
            }

        }
    }
}
