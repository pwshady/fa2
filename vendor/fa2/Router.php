<?php

namespace fa2;

class Router
{

    protected static string $page = '';
    protected static string $request = '';
    protected static string $params = '';

    public static function dispatch($url)
    {
        if (false) {

        } else {
            self::queryParsing($url);
            if (is_dir(PAGE . self::$page . '_' . self::$request))
            {
                $controller = 'app\pages' . self::$page . '_' . self::$request . '\\_Controller';
                $controller = str_replace('/', '\\', $controller);
                if (class_exists($controller)) {
                    echo '<br>ok cont single';
                    $controllerObj = new $controller(self::$page, self::$request);
                    die;
                }
            }
            if (is_dir(PAGE . self::$page . '__')) {
                $controller = 'app\pages' . self::$page . '__\__Controller';
                $controller = str_replace('/', '\\', $controller);
                if (class_exists($controller)) {
                    echo '<br>ok cont multi';
                    $controllerObj = new $controller(self::$page, self::$request);
                    die;
                }
            }
            echo self::$page;
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
            self::$params = $arr[1];
        }
        self::$page = rtrim(self::$page, '/') . '/';
        self::$request = rtrim(self::$request, '/');
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

            self::$page = $page . $arr[0] . '/';

            if (count($arr) == 2) {
                self::$request = $arr[1];
                self::getPage($page . $arr[0] . '/', $arr[1]);
            } else {
                self::$request = '';
            }
        } else {
            self::$page = $page;
            self::$request = $request;
        }
    }

}
