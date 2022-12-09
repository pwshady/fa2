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

    public function getModel()
    {
        echo '<br>Model of dir ' . $this->dir;
        echo '<br>';
    }

}