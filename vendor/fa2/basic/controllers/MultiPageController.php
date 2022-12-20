<?php

namespace fa2\basic\controllers;

class MultiPageController extends PageController
{

    public function run()
    {
        echo '<h1>BasicMultiController</h1>';
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
            $controller = new MultiPageController('/vendor/fa2/pages/samples/__/', []);
            $controller->run();
        }
    }
}