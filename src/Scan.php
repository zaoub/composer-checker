<?php

namespace Zaoub\ComposerChecker;

use Zaoub\ComposerChecker\{Config, SendResults, ShowData};
use SensioLabs\Security\SecurityChecker;

class Scan
{
    public function __construct($options = []) {
        $this->config = new Config($options);
        $this->send = new SendResults;
        $this->show = new ShowData;
    }

    /**
     * Run the scan
     * 
     * @return string
     */
    public function run()
    {
        if ($this->config['type_results'] == 'text') {
            echo "\e[1;33mChecking... \e[0m".PHP_EOL;
        }

        $checker = new SecurityChecker();
        $result = $checker->check($this->config['composer_lock_path'], 'json');
        $alerts = json_decode((string) $result, true);
        
        $this->show->data($alerts);
        $this->show->run($this->config);
        $this->send->run($this->config);
    }
}