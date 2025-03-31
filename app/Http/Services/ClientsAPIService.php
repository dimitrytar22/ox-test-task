<?php

namespace App\Http\Services;

use GuzzleHttp\Client;

class ClientsAPIService
{
    public static function getClients()
    {
        $url = config('clients_api.api_url'). "?key=" .config('clients_api.api_key');
        $client = new Client();
        $response = $client->request("GET", $url);
        if($response->getStatusCode() !== 200){
            throw new \Exception("Error getting clients!");
        }
        $data = json_decode($response->getBody()->getContents(),true);
        return $data;
    }
}
