<?php

namespace fa2;

class PageController extends Controller
{

    public function __construct($page, $request, $params)
    {
        echo '<h1>PageController Job</h1>';
        echo 'page: ';
        debug($page);
        echo 'request: ';
        debug($request);
        echo 'params: ';
        debug($params);
        $this->run();
    }

    protected function run()
    {
        $dir = $this->getDir();
        $this->getSettings($dir);
        $baseLanguage = isset(App::$app->getProperty('settings')['baseLanguage']) ? App::$app->getProperty('settings')['baseLanguage'] : 'en';
        echo '<h1>' . $baseLanguage . '</h1>';
        //$this->getLabels($dir);//jjjj
        $this->getVidgets($dir);

        debug(App::$app->getLanguage());
        debug($_SESSION);
        debug(App::$app->getProperties());
    }

}
