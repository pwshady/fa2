<?php

namespace fa2\basic\controllers;

class MultiPageController extends PageController
{

    public function run()
    {
        self::job();
        self::getView();
    }

    public function getView()
    {
        if ( file_exists(ROOT . $this->dir . 'view.php')) {
            ob_start();
            require_once ROOT . $this->dir . 'view.php';
            $view = ob_get_clean();
            self::render($view);
        } else {
            $controller = new PageController('/vendor/fa2/pages/', ['samples', 'multi']);
            $controller->run();
        }
    }
}