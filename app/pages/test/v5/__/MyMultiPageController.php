<?php

namespace app\pages\test\v5\__;

use fa2\basic\controllers\MultiPageController;

class MyMultiPageController extends MultiPageController
{

    public function run()
    {
        echo '<h1>MyMultiController</h1>';
        echo '<h2>' . $this->dir . '</h2>';
    }

}