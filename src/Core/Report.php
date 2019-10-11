<?php

namespace Zaoub\Dependo\Core;

use Zaoub\Dependo\lib\Format;

class Report
{
    public function __construct($config = []) {
        $this->config = $config;        
    }

    public function setData($data)
    {
        $this->config['data'] = $data;

        $this->format = new Format($this->config['data']);
    }

    public function run($type)
    {
        if ($type == 'json') {
            return $this->format->json();
        }

        if (!count($this->config['data'])) {
            die(PHP_EOL."\e[0;32m>> You are in safe mode\e[0m".PHP_EOL);
        }

        return $this->format->text();
    }
}