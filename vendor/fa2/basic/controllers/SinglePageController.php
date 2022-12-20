<?php

namespace fa2\basic\controllers;

class SinglePageController extends PageController
{

    public function run()
    {
        echo '<h1>SingleController</h1>';
        echo '<h2>' . $this->dir . '</h2>';
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
            $controller = new SinglePageController('/vendor/fa2/pages/samples/_/', []);
            $controller->run();
        }
    }

}