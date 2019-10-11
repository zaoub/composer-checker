<?php

namespace Zaoub\Dependo\lib;

use GuzzleHttp\Client;

class PingData
{
    public function __construct($config = []) {
        $this->config = $config;

        $this->client = new Client([
            'base_uri' => $this->config['base_uri']
        ]);
    }

    public function run()
    {
        $response = $this->client->post('/1570817394321-9374461702536', [
            'debug' => false,
            'form_params' => [
                'results' => $this->config['data']
            ],
            'headers' => [
                'Content-Type' => 'Content-Type: application/json',
            ]
        ]);
    }
}