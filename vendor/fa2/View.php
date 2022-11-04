<?php

namespace fa2;

class View
{

    public function __construct()
    {
    }

    public function render($view, $data = [])
    {
        if (is_file($view)){
            ob_start();
            require $view;
        }
        debug(App::$app->getProperties());

        $html = ob_get_clean();
        echo '<h1>PageComplite</h1>';
        return $html;
    }

}
