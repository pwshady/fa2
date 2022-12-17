<?php

namespace fa2\basic\models;

use fa2\App;

class Model
{
    public function __construct(public $dir)
    {

    }

    public function run(){}

    public function getAccess()
    {
        if (file_exists(ROOT . $this->dir . 'access.json')) {
            
            $access = json_decode(file_get_contents(ROOT . $this->dir . 'access.json', true));
            App::$app->addAccess($access);
        }
    }

    public function getErrors()
    {
        if (file_exists(ROOT . $this->dir . 'access.json')) {
            
            $access = json_decode(file_get_contents(ROOT . $this->dir . 'access.json', true));
            App::$app->setErrors($access);
        }
    }

    public function getSettings()
    {
        if (file_exists(ROOT . $this->dir . 'access.json')) {
            
            $access = json_decode(file_get_contents(ROOT . $this->dir . 'access.json', true));
            App::$app->setSettings($access);
        }
    }

    public function getVidgets()
    {
        if (file_exists(ROOT . $this->dir . 'access.json')) {
            
            $access = json_decode(file_get_contents(ROOT . $this->dir . 'access.json', true));
            App::$app->setVidgets($access);
        }
    }

    public function grtLabels()
    {
        if (file_exists(ROOT . $this->dir . 'access.json')) {
            
            $access = json_decode(file_get_contents(ROOT . $this->dir . 'access.json', true));
            App::$app->setVidgets($access);
        }
    }

    public function getDatas()
    {
        if (file_exists(ROOT . $this->dir . 'access.json')) {
            
            $access = json_decode(file_get_contents(ROOT . $this->dir . 'access.json', true));
            App::$app->setDatas($access);
        }
    }

}
