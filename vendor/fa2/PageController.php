<?php

namespace fa2;

class PageController extends Controller
{

    public function __construct($page, $request)
    {
        $this->run();
    }

    protected function run($page = [], $request = '')
    {
        echo '<br>=================Controller';
        $this->getModel($page, $request); 
        //$this->getSettings($dir);
        //$this->getLabels($dir);
        //$this->getVidgets($dir);
        //$this->creatModel();
        //$this->creatVidgets();
        //debug($dir);
        //debug(App::$app->getProperties());
        //$this->creatView($dir . '/indexView.php');
    }



    //
    protected function getSettings($dir)
    {
        $settings = [];
        $filePath = CONFIG . '/settings.json';
        if (is_file($filePath)){
            $settings = json_decode(file_get_contents($filePath), true);
        }
        $filePath = $dir . '/settings.json';
        if (is_file($filePath)){
            $settings = array_merge($settings, json_decode(file_get_contents($filePath), true));
        }
        App::$app->setProperty('settings', $settings);
    }

    protected function getVidgets($dir)
    {
        $filePath = $dir . '/vidgets.json';
        if (is_file($filePath)){
            $vidgets = json_decode(file_get_contents($filePath), true);
            App::$app->setProperty('vidgets', $vidgets);
        }
    }

    protected function creatVidgets()
    {
        echo '<h1>VidgetsComplite</h1>';
    }

    protected function creatView($view)
    {
        $html = (new View())->render($view);
        echo $html;
    }



}
