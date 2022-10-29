<?php

namespace fa2;

class Router
{

    protected static string $page = '';
    protected static string $request = '';
    protected static array $params = [];

    public static function dispatch($url)
    {
        if (false) {

        } else {
            self::queryParsing($url);
        }
    }

    protected static function queryParsing($url)
    {
        $arr = explode('&', $url, 2);
        self::$page = $arr[0];
        self::getLanguage();
        debug(self::$page);
        debug(self::$request);
        debug(self::$params);
        echo App::$app->getLanguage();
    }

    protected static function getLanguage()
    {
        $arr = explode('/', self::$page, 2);
        if (strlen($arr[0]) == 2) {
            App::$app->setLanguage($arr[0]);
            if (count($arr) == 2) {
                self::$page = $arr[1];
            } else {
                self::$page = '';
            }
        }
    }



}
