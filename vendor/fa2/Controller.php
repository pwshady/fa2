<?php

namespace fa2;

abstract class Controller 
{

    protected array $settings = [];

    protected function run(){}

    protected function createView(){}

    protected function getLabels($dir, $prefix = '')
    {
        $labels = [];
        $filePath = $dir . '/language/' . App::$app->getLanguage() . '.json';
        if (file_exists($filePath)){
            $labels = json_decode(file_get_contents($filePath), true);
        } else {
            $baseLanguage = isset(App::$app->getProperty('settings')['baseLanguage']) ? App::$app->getProperty('settings')['baseLanguage'] : 'en';
            $filePath = $dir . '/language/' . $baseLanguage . '.json';
            if (file_exists($filePath)){
                $labels = json_decode(file_get_contents($filePath), true);
            }
        }
        App::$app->addProperty('labels', $labels);
    }

    protected function creatModel()
    {
        echo '<h1>ModelComplite</h1>';
    }

}
