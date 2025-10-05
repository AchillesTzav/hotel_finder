<?php

namespace App\Services\LiteAPI;

class LiteAPI extends LiteAPIClient
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get countries static data from LiteAPI 
     */
    public function getCountries()
    {
        $response = $this->client->request('GET', 'data/countries?timeout=4');

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get cities static data from LiteAPI 
     * @param string $countryCode
     */
    public function getCities($countryCode)
    {
        $response = $this->client->request('GET', 'data/cities?countryCode='.$countryCode.'&timeout=4');

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get Hotels searching with only country code
     * @param string $countryCode
     */
    public function getHotels($countryCode)
    {
        $response = $this->client->request('GET', 'data/hotels?countryCode='.$countryCode.'&timeout=4');

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get countries static data from LiteAPI
     * @param string $countryCode
     * @param string $cityName
     */
    public function searchHotels($countryCode, $cityName)
    {
        $response = $this->client->request('GET', 'data/hotels?countryCode='.$countryCode.'&cityName='.$cityName.'&timeout=4');

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get minimun hotel rates from LiteAPI
     * @param array $data
     *  'occupancies', 'checkin', 'checkout', 'countryCode', 'cityName', 'currency'
     */
    public function getMinHotelRates($data){
        $response = $this->client->request('POST', 'hotels/min-rates', [
            'body' => json_encode($data),
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get hotel room data and rates
     * @param array $search_params
     */
    public function getHotelRates($search_params)
    {
        $response = $this->client->request('POST', 'hotels/rates', [
            'body' => json_encode($search_params),
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
    
}
