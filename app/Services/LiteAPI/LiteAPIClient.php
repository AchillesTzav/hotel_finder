<?php 

namespace App\Services\LiteAPI; 

use GuzzleHttp\Client;

class LiteAPIClient {
 
    public $client;

    public function __construct() {
        $this->client = new Client([
            'base_uri' => env('LITEAPI_BASE_URI'),
            'headers' => [
                'X-API-Key' => env('LITEAPI_SAND_KEY'),
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ],
        ]);
    }
}