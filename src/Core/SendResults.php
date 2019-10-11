<?php

namespace Zaoub\Dependo\Core;
use Zaoub\Dependo\lib\PingData;

class SendResults
{
    public function __construct($config = []) {
        $this->config = $config;
        $this->PingData = new PingData($config);
    }

    public function run()
    {

        if ($this->config['send'] == 'yes') {
            // send data to zaoub
            $this->PingData->run();
            exit;
        }

        echo PHP_EOL."\e[1;33mYou want sent this result to zaoub app? (Y\N): \e[0m";

        $answer = trim(fgets(STDIN));
        $answer = strtoupper($answer);

        if ($answer === 'N') {
            echo "\e[1;33mThanks No the results have been sent.\e[0m";
            return PHP_EOL;
        }

        echo "\e[1;33mSending results... \e[0m".PHP_EOL;

        // send data to zaoub
        $this->PingData->run();
        
        // echo "\e[1;31mThis feature is currently inactive.\e[0m";
    }
}