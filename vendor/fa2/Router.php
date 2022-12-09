<?php

namespace fa2;

use fa2\basic\controllers;

class Router
{

    protected static array $page = [];
    protected static string $request = '';

    public static function dispatch($url, $lang = false)
    {
        $url = self::removeQueryString($url);
        self::getPage($url);
        if ($lang){
            self::getLanguage($url);
        } else {
            self::$request = $url;
        }
        debug(self::$page);
        self::run();
    }

    protected static function removeQueryString($url)
    {
        if ($url) {
            $url_arr = explode('&', $url, 2);
            if (str_contains($url_arr[0], '=') === false) {
                return rtrim($url_arr[0], '/');
            }
        }
        return '';
    }

    protected static function getLanguage($url)
    {

    }

    protected static function getPage($url)
    {
        self::$page = explode('/', $url);
    }

    protected static function run()
    {
        $cont = new basic\controllers\PageController('/app/pages', self::$page);
        $cont->run();
    }
}