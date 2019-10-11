<?php

namespace Zaoub\Dependo;

use Zaoub\Dependo\Config;
use Zaoub\Dependo\Core\Report;

use SensioLabs\Security\SecurityChecker;

class Signal
{
    public function __construct() {
        $this->config = new Config([]);
        $this->report = new Report($this->config);
    }

    /**
     * Run the scan
     * 
     * @return string
     */
    public function run()
    {
        $checker = new SecurityChecker();
        $result = $checker->check($this->config['composer_lock_path'], 'json');
        $alerts = json_decode((string) $result, true);
        
        $this->report->setData($alerts);
        echo $this->report->run('json');
    }
}