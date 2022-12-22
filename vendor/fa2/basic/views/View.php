<?php

namespace fa2\basic\views;

use fa2\App;

class View
{
    public function __construct(public $dir, public $name){}

    public function run()
    {

    }

    public function render()
    {
        $labels = App::$app->getLabels();
        ob_start();
        require_once ROOT . $this->dir . $this->name . 'View.php';
        return ob_get_clean();
    }

}