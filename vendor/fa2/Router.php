<?php

namespace fa2;

class Router
{

    protected static array $page = [];
    protected static string $request = '';

    public static function dispatch($url, $lang = false)
    {
        echo '<br>url: ' . $url; 
        if ($lang){
            self::getLanguage($url);
        } else {
            self::$request = $url;
        }
        self::getPage($url);
        self::run();
    }

    protected static function getLanguage($url)
    {

    }

    protected static function getPage($url)
    {
        $url_arr = explode('&', $url, 2);
        debug($url_arr);
    }

    protected static function run()
    {

    }
}