<?php

namespace Zaoub\Dependo\Core;

use Zaoub\Dependo\lib\Format;

class Report
{
    public function __construct($config = []) {
        $this->config = $config;
        $this->send = new SendResults($this->config);
    }

    public function setData($data)
    {
        $this->config['data'] = $data;

        $this->format = new Format($this->config['data']);
    }

    public function run($type)
    {
        if ($type == 'json') {
            $data = $this->format->json();
        }

        if (!count($this->config['data'])) {
            die(PHP_EOL."\e[0;32m>> You are in safe mode\e[0m".PHP_EOL);
        }

        $data = $this->format->text();

        echo $data;

        if (!empty($data)) {
            $this->config['data'] = $this->format->json();
            $this->send->run($this->config);
        }
    }
}