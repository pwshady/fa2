<?php

namespace app\pages\test\v6\t\_;

use fa2\basic\controllers\SinglePageController;

class MySinglePageController extends SinglePageController
{

    public function run()
    {
        echo '<h1>SingleController</h1>';
        echo '<h2>' . $this->dir . '</h2>';
    }

}