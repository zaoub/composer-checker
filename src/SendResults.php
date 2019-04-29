<?php

namespace Zaoub\ComposerChecker;

class SendResults
{
    public function run()
    {
        echo "\e[1;33mYou want sent this result to zaoub app? (Y\N): \e[0m";

        $answer = trim(fgets(STDIN));
        $answer = strtoupper($answer);

        if ($answer === 'N') {
            echo "\e[1;33mThanks No the results have been sent.\e[0m";
            return PHP_EOL;
        }

        echo "\e[1;33mSending results... \e[0m".PHP_EOL;
        echo "\e[1;31mThis feature is currently inactive.\e[0m";
    }
}