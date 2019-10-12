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
        if (!isset($this->config['project_key'])) {
            \Zaoub\Dependo\Core\Console::log('<< We need the keys to send [keys]: ', 'cyan', false);

            $keys = trim(fgets(STDIN));

            $this->config->setKeys($keys);
        }

        try {
            $response = $this->client->post('/api/v1/dependo/receive', [
                'debug' => false,
                'json' => [
                    'results' => $this->config['data']
                ],
                'headers' => [
                    'Content-Type' => 'Content-Type: application/json',
                    'X-zaoub-project-key' => $this->config['project_key'],
                    'X-zaoub-visa' => hash_hmac('sha256', $this->config['project_key'], $this->config['project_secret'].$this->config['secret_key'])
                ]
            ]);
    
            $data = $response->getBody()->getContents();
            $data = json_decode($data, true);
    
            if ($data['status'] == 'success') {
                \Zaoub\Dependo\Core\Console::log('>> '.$data['message'], 'green');
            }
    
            if ($data['status'] == 'error') {
                \Zaoub\Dependo\Core\Console::log('>> '.$data['message'], 'red');
            }
        } catch (\Throwable $th) {
            die(\Zaoub\Dependo\Core\Console::log($th, 'red'));
        }
    }
}