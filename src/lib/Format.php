<?php

namespace Zaoub\Dependo\lib;

class Format
{
    public function __construct($data = []) {
        $this->data = $data;
    }

    public function json()
    {
        $out_json = [];
        foreach ($this->data as $vendor => $i) {
            $out_json []= [
                'vendor' => $vendor,
                'version' => $i['version'],
                'advisories' => $this->advisories_filter($i['advisories']),
            ];
        }
        return json_encode($out_json);
    }

    public function text()
    {
        $text = "\e[0;31mNumber of vulnerability packets: ".count($this->data)."\e[0m".PHP_EOL;
        $text .= '------------------------------------------------------------'.PHP_EOL;
        foreach ($this->data as $vendor => $i) {
			$text .= 'Vendor: '.$vendor.PHP_EOL;
            $text .= 'Version: '.$i['version'].PHP_EOL;
            $text .= 'Advisories:-'.PHP_EOL;
			foreach ($i['advisories'] as $advisorie) {
				$text .= '    Title: '.$advisorie['title'].PHP_EOL;
				$text .= '    Cve: '.$advisorie['cve'].PHP_EOL;
				if (end($i['advisories']) != $advisorie) {
					$text .= '    ----'.PHP_EOL;
				}
			}
            $text .= '------------------------------------------------------------'.PHP_EOL;
        }
        return $text;
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