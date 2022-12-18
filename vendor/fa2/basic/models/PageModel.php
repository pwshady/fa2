<?php

namespace fa2\basic\models;

use fa2\App;

class PageModel extends Model
{
    public function __construct(public $dir)
    {

    }

    public function run()
    {
        echo '<br>=RunModel: ' . $this->dir;
        self::getAccess();
        self::getErrors();
        self::getSettings();
        self::getLabels();
        self::getVidgets();
    }

    public function getVidgets()
    {
        if (file_exists(ROOT . $this->dir . 'access.json')) {
            
            $access = json_decode(file_get_contents(ROOT . $this->dir . 'access.json', true));
            App::$app->setVidget($access);
        }
    }

}