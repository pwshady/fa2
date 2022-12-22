<?php

namespace fa2\basic\controllers;

use fa2\App;

class MultiPageController extends PageController
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
                $view_path = 'fa2\basic\views\View';
                $view = new $view_path($this->dir, $view_name);
                $view->run();
                self::render($view->render());
            } else {
                $controller = new PageController('/vendor/fa2/pages/', ['samples', 'multi']);
                $controller->run();
            }
        }
    }
}