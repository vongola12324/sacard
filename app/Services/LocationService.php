<?php

namespace App\Services;

class LocationService
{
    /**
     * @param string $address
     * @return array
     * @throws \HttpRequestException
     */
    public static function getLocation($address)
    {
        if (!env('GOOGLE_API_SERVER_KEY')) {
            throw new \HttpRequestException('Google API Key Not Found!! Make sure that you have set KEY in your .env file.');
        }
        // set url
        $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&key=' . env('GOOGLE_API_BROWSER_KEY');

        // get the json response
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        $resp_json = curl_exec($ch);

        // decode the json
        $resp = json_decode($resp_json, true);

        // check response
        if ($resp['status'] == 'OK') {
            $lati = $resp['results'][0]['geometry']['location']['lat'];
            $longi = $resp['results'][0]['geometry']['location']['lng'];
            // check data
            if ($lati && $longi) {
                $location = [$longi, $lati];

                return $location;
            }
        }

        return [];
    }
}
