<?php

namespace Zaoub\ComposerChecker;

class ShowData
{
    /**
     * Receiving data from outside this class
     * 
     * @param array $data
     * 
     * @return string
     */
    public function data($data) {
        $this->data = $data;
    }

    /**
     * Turn on data display
     * 
     * @return string
     */
    public function run()
    {
        foreach ($this->data as $i) {
            echo 'Title: '.$i['advisories'][0]['title'].PHP_EOL;
            echo 'Version: '.$i['version'].PHP_EOL;
            echo 'Cve ID: '.$i['advisories'][0]['cve'].PHP_EOL;
            echo '------------------------------------------------------------'.PHP_EOL;
        }
    }
}