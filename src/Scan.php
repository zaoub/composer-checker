<?php

namespace Zaoub\ComposerChecker;

use Zaoub\ComposerChecker\{Config, SendResults, ShowData};
use SensioLabs\Security\SecurityChecker;

class Scan
{
    public function __construct() {
        $this->config = new Config;
        $this->send = new SendResults;
        $this->show = new ShowData;
    }

    public function run()
    {
        echo "\e[1;33mChecking... \e[0m".PHP_EOL;

        $checker = new SecurityChecker();
        $result = $checker->check($this->config['composer_lock_path'], 'json');
        $alerts = json_decode((string) $result, true);
        
        echo "\e[0;31mNumber of vulnerability packets: ".count($alerts)."\e[0m".PHP_EOL;
        echo '------------------------------------------------------------'.PHP_EOL;
        if (count($alerts)) {
            $this->show->data($alerts);
            $this->show->run();

            $this->send->run();
        }
    }
}