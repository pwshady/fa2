<?php

namespace fa2;

abstract class Controller 
{

    protected array $settings = [];

    protected function run(){}

    protected function getDir(){}

    protected function getSettings($dir, $prefix = '')
    {
        $settings = [];
        if (file_exists(CONFIG . '/settings.json'))
        {
            echo '<h1>uuuu</h1>';
            //$settings = json_decode(file_get_contents($filePath), true);
        }
        $filePath = $dir . '/settings.json';
        if (file_exists($filePath)){
            $settings = json_decode(file_get_contents($filePath), true);
            App::$app->setProperty('settings', $settings);
        }
    }

    protected function getVidgets($dir, $prefix = '')
    {
        $filePath = $dir . '/vidgets.json';
        if (file_exists($filePath)){
            $vidgets = json_decode(file_get_contents($filePath), true);
            App::$app->setProperty('vidgets', $vidgets);
        }
    }

}
