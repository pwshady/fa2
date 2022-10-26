<?php

namespace fa2;

class App
{

    public static $app;

    public function __construct()
    {
        self::$app = Registry::getInstance();
        //$this->getParams();
    }

    public function getParams()
    {
        $self::$app->setProperty('1', 'test');
    }

}
