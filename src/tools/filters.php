<?php

use voku\helper\AntiXSS;

require './vendor/autoload.php';


class Filters
{

    private $xss;

    function __construct()
    {
        $this->xss = new AntiXSS();
    }

    public function Xss($text)
    {
        return $this->xss->xss_clean($text);
    }



    public function isNum($str)
    {

        if (preg_match('/[^0-9]/', $str) > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function isAlNum($str, $condition = '')
    {

        if (preg_match('/[^a-zA-Z0-9' . $condition . ']/', $str) > 0) {
            return false;
        } else {
            return true;
        }
    }


    public function Alfa($str, $condition = null)
    {
        $condition == null ? $regex = '/[^a-zA-Zà-úÀ-Ú]/u' : $regex = '/[^a-zA-Zà-úÀ-Ú' . $condition . ']/u';
        return preg_replace($regex, '', $str);
    }

    public function alNum($str, $condition = null)
    {
        $condition == null ? $regex = '/[^a-zA-Zà-úÀ-Ú0-9]/u' : $regex = '/[^a-zA-Zà-úÀ-Ú0-9' . $condition . ']/u';
        return preg_replace($regex, '', $str);
    }

    public function Num($str, $condition = null)
    {
        $condition == null ? $regex = '/[^0-9]/u' : $regex = '/[^0-9' . $condition . ']/u';
        return preg_replace($regex, '', $str);
    }

    public function termSearch($term)
    {
        $normalizer = Normalizer::normalize($term, Normalizer::FORM_D);
        $normalizer = preg_replace('/\p{Mn}/u', '', $normalizer);

        return strtolower(trim($normalizer));
    }


    public function jsonValid($data)
    {
        if (!empty($data)) {
            return is_string($data) &&
                is_array(json_decode($data, true)) ? true : false;
        }
        return false;
    }


    public function emailValid($email)
    {
        return preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $email);
    }

    public function generateUUID($data = null)
    {
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);

        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public function validUUID($uuid)
    {

        if (!is_string($uuid) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $uuid) !== 1)) {
            return false;
        }

        return true;
    }

    public function isBase64($string) {
        return (bool) preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string);
    }

    function scapeString($string) {

        $palavrasChavePrejudiciais = [
            'eval',
            'exec',
            'system',
            'shell_exec',
            'passthru',
            'phpinfo',
            'php',
            'echo'
        ];
    
        foreach ($palavrasChavePrejudiciais as $palavraChave) {
            if (stripos($string, $palavraChave) !== false) {
                $string = str_ireplace($palavraChave, '*', $string);
            }
        }

        return $string;
    }
}
