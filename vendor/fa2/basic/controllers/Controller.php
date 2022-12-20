<?php

namespace fa2\basic\controllers;

class Controller
{

    public function __construct($dir)
    {
        echo '<br>=====dir: ' . $dir;
    }

    public function run()
    {
        echo '<br>run';
    }

    public function runModel()
    {
        echo '<br>Model of dir ' . $this->dir;
        echo '<br>';
    }

    public function render($view)
    {
        echo '<br>View of dir ' . $this->dir;
    }

}