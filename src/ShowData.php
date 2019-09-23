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
    public function run($config)
    {
        if ($config['type_results'] == 'json') {
            $out_json = [];
            foreach ($this->data as $i) {
                $out_json []= [
                    'title' => $i['advisories'][0]['title'],
                    'version' => $i['version'],
                    'cve_id' => $i['advisories'][0]['cve'],
                ];
            }
            echo json_encode($out_json);
            return false;
        }

        if (!count($this->data)) {
            echo "\e[0;32mYou are in safe mode\e[0m".PHP_EOL;
            exit;
        }

        echo "\e[0;31mNumber of vulnerability packets: ".count($this->data)."\e[0m".PHP_EOL;
        echo '------------------------------------------------------------'.PHP_EOL;

        foreach ($this->data as $i) {
            echo 'Title: '.$i['advisories'][0]['title'].PHP_EOL;
            echo 'Version: '.$i['version'].PHP_EOL;
            echo 'Cve ID: '.$i['advisories'][0]['cve'].PHP_EOL;
            echo '------------------------------------------------------------'.PHP_EOL;
        }
    }
}