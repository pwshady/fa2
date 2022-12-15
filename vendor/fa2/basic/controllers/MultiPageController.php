<?php

namespace fa2\basic\controllers;

class MultiPageController extends PageController
{

    public function run()
    {
        echo '<h1>BasicMultiController</h1>';
        echo '<h2>' . $this->dir . '</h2>';
        self::job();
    }

}