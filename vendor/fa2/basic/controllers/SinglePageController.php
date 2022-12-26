<?php

namespace fa2\basic\controllers;

use fa2\App;

class SinglePageController extends PageController
{

    public function run()
    {
        self::job();
        self::getView();
    }

    public function getView()
    {
        if ( file_exists(ROOT . $this->dir . 'View.php' )) {
            self::runView();
        } else {
            $view_name = App::$app->getSetting('view') ? App::$app->getSetting('view') : 'index';
            if ( file_exists(ROOT . $this->dir . $view_name . 'View.php') ) {
                echo self::createdView($view_name);
            } else {
                $controller = new PageController('/vendor/fa2/pages', ['samples', 'single']);
                $controller->run();
            }
        }
    }



}