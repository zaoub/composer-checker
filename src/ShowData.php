<?php

namespace Zaoub\Dependo;

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
            foreach ($this->data as $vendor => $i) {
                $out_json []= [
					'vendor' => $vendor,
                    'version' => $i['version'],
                    'advisories' => $this->advisories_filter($i['advisories']),
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
        foreach ($this->data as $vendor => $i) {
			echo 'Vendor: '.$vendor.PHP_EOL;
            echo 'Version: '.$i['version'].PHP_EOL;
            echo 'Advisories:-'.PHP_EOL;
			foreach ($i['advisories'] as $advisorie) {
				echo '    Title: '.$advisorie['title'].PHP_EOL;
				echo '    Cve: '.$advisorie['cve'].PHP_EOL;
				if (end($i['advisories']) != $advisorie) {
					echo '    ----'.PHP_EOL;
				}
			}
            echo '------------------------------------------------------------'.PHP_EOL;
        }
    }
	
	public function advisories_filter($advisories)
	{
		$out_data = [];
		foreach ($advisories as $advisorie) {
			$out_data []= [
				'title' => $advisorie['title'],
				'cve' => $advisorie['cve']
			];
		}
		return $out_data;
	}
}