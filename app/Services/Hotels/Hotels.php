<?php

namespace App\Services\Hotels;

use GuzzleHttp\Client;

//use GuzzleHttp\Client;

class Hotels
{
    public function ping() {
        $client = new Client([
            'base_uri' => '',
        ]);

         $response = $client->request('GET', '/ping', [
            'headers' => [
                
                'accept' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}

    
