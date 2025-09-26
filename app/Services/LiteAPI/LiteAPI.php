<?php

namespace App\Services\LiteAPI;

use GuzzleHttp\Client;

class LiteAPI extends LiteAPIClient
{
    public function __construct() {
        parent::__construct();
    }

    public function getCountries()
    {
        $response = $this->client->request('GET', 'countries?timeout=4');

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getCities($countryCode)
    {
        $response = $this->client->request('GET', 'cities?countryCode=' . $countryCode . '&timeout=4');

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getHotels($countryCode) {
        $response = $this->client->request('GET', 'hotels?countryCode=' . $countryCode . '&timeout=4');

        return json_decode($response->getBody()->getContents(), true);
    }

    public function searchHotels($countryCode, $cityName) {
        $response = $this->client->request('GET', 'hotels?countryCode=' . $countryCode . '&cityName=' . $cityName . '&timeout=4');

        return json_decode($response->getBody()->getContents(), true); 
    }

    public function getHotelRates($search_params) {

        /**
         * @todo required params: 
         *     check-in + check-out, 
         *     currency, 
         *     guestNationality, (country code) 
         *     hotel-id/ city / country,
         * 
         *  @base_uri https://api.liteapi.travel/v3.0/hotels/rates
         * 
         *  @body '{"occupancies":[{"adults":2,"children":[7,5]},{"adults":1}],"currency":"USD","guestNationality":"US","checkin":"2025-11-01","checkout":"2025-11-02","cityName":"New York"}'
         */

         $response = $this->client->request('POST', 'hotels/rates', [
            'body' => $search_params,
         ]);

         return json_decode($response->getBody()->getContents(), true);

    }
}
