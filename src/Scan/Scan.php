<?php

namespace Zaoub\ComposerChecker\Scan;

use Zaoub\ComposerChecker\Config;

class Scan implements ArrayAccess
{
    public function __construct(Config $config) {
        $this->config = $config;
    }

    public function run()
    {
        return $this->config['composer_lock_path'];
    }
}