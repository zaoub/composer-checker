<?php

namespace Zaoub\Dependo;

use Zaoub\Dependo\Config;
use Zaoub\Dependo\Core\Report;
use Zaoub\Dependo\Core\SendResults;

use SensioLabs\Security\SecurityChecker;

class Scan
{
    public function __construct($options = []) {
        $this->config = new Config($options);
        $this->report = new Report($this->config);
    }

    /**
     * Run the scan
     * 
     * @return string
     */
    public function run()
    {
        echo "\e[1;33mChecking... \e[0m".PHP_EOL;

        $checker = new SecurityChecker();
        $result = $checker->check($this->config['composer_lock_path'], 'json');
        $alerts = json_decode((string) $result, true);
        
        $this->report->setData($alerts);
        echo $this->report->run('text');
    }
}