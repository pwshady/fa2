<?php

namespace fa2;

class App
{

    public static $app;

    public function __construct()
    {
        $query = trim(urldecode($_SERVER['QUERY_STRING']), '/');
        new ErrorHandler();
        self::$app = Registry::getInstance();
        Router::dispatch($query);
        //$this->getParams();
        //debug(self::$app->getProperties());
    }

    public function getParams()
    {
        self::$app->setProperty('test', 'test');
    }

}
