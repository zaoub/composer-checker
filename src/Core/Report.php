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
            return $this->format->json();
        }

        if (!count($this->config['data'])) {
            die(\Zaoub\Dependo\Core\Console::log('>> You are in safe mode', 'green'));
        }

        $data = $this->format->text();

        echo $data;

        if (!empty($data)) {
            $this->config['data'] = $this->format->json();
            $this->send->run($this->config);
        }
    }
}