<?php

namespace App\Services\LiteAPI;

use GuzzleHttp\Client;

class LiteAPI
{

    public function getCountries()
    {
        $client = new Client([
            'base_uri' => 'https://api.liteapi.travel/v3.0/data/',
        ]);

        $response = $client->request('GET', 'countries?timeout=4', [
            'headers' => [
                'X-API-Key' => env('LITEAPI_SAND_KEY'),
                'accept' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }


    public function getCities($countryCode)
    {

        // https://api.liteapi.travel/v3.0/data/cities?countryCode=GR&timeout=4

        $client = new Client([
            'base_uri' => 'https://api.liteapi.travel/v3.0/data/',
        ]);


        $response = $client->request('GET', 'cities?countryCode=' . $countryCode . '&timeout=4', [
            'headers' => [
                'X-API-Key' => env('LITEAPI_SAND_KEY'),
                'accept' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
