<?php

namespace fa2\basic\controllers;

class SinglePageController extends PageController
{

    public function run()
    {
        echo '<h1>SingleController</h1>';
        echo '<h2>' . $this->dir . '</h2>';
        self::job();
        self::render();
    }

}