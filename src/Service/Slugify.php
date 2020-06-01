<?php


namespace App\Service;


class Slugify
{
    public function generate(string $input) : string
    {
        if (is_null($input)) {
            return "";
        }
        $input = mb_strtolower(trim($input), 'UTF-8');
        $array = [
            'à','á','â','ã','ä',
            'ç','ñ','ý','ÿ',
            'è','é','ê','ë',
            'ì','í','î','ï',
            'ò','ó','ô','õ','ö',
            'ù','ú','û','ü',
            '!','?','(',')','+','/','§','%','=','&',
            ',','.',':',';',
            '--','---',"'", '"','_',
            ' ',
        ];
        $arrayReplace = [
            'a','a','a','a','a',
            'c','n','y','y',
            'e','e','e','e',
            'i','i','i','i',
            'o','o','o','o','o',
            'u','u','u','u',
            '','','','','','','','','','',
            '','','','',
            '-','-','','','',
            '-'
        ];
        $input = str_replace($array, $arrayReplace, $input);
        return $input;
    }
}