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
            if (is_dir(PAGE . self::$page . '_'))
            {
                $controller = 'app\pages' . self::$page . '_' . '\\_' . self::$request . '\\Controller';
                $controller = str_replace('/', '\\', $controller);
                if (class_exists($controller)) {
                    echo '<br>ok cont single';

                    die;
                }
            }
            if (is_dir(PAGE . self::$page . '__')) {
                $controller = 'app\pages' . self::$page . '__\__Controller';
                $controller = str_replace('/', '\\', $controller);
                if (class_exists($controller)) {
                    echo '<br>ok cont multi';
                    die;
                }
            }
            echo 'Page not found';
        }
    }

    protected static function queryParsing($url)
    {
        $arr = explode('&', $url, 2);
        if ( str_contains($arr[0], '=') === true) {
            $arr[0] = '';
            $arr[1] = $url;
        }
        self::$page = $arr[0];
        self::getLanguage();
        self::getPage('/', self::$page);
        if (count($arr) == 2) {
            self::getParams($arr[1]);
        }
        self::$page = rtrim(self::$page, '/') . '/';
        self::$request = rtrim(self::$request, '/');
        echo 'page: ';
        debug(self::$page);
        echo 'request: ';
        debug(self::$request);
        echo 'params: ';
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

    protected static function getPage($page, $request)
    {
        $arr = explode('/', $request, 2);
        if (is_dir(PAGE . $page . $arr[0])) {

            if (file_exists(PAGE . $page . $arr[0] . '/access.json')) {
                $access = self::accessCheck();
                if ($access != '') {
                    echo $access;
                    return;
                }
            } 
            self::$page = $page . $arr[0] . '/';

            if (count($arr) == 2) {
                self::$request = $arr[1];
                self::getPage($page . $arr[0] . '/', $arr[1]);
            } else {
                echo '<br>   ' . self::$page;
                self::$request = '';
            }
        } else {
            self::$page = $page;
            self::$request = $request;
        }
    }

    protected static function accessCheck()
    {
        return '<H1>ACCESS DENIED11</H1>';
    }

    protected static function getParams($params)
    {
        self::$params[0] = $params;
    }

}
