<?php

namespace app\pages\test\v1;

use fa2\basic\controllers\PageController;

class MyPageController extends PageController
{

    public function run()
    {
        echo '<h1>MyPageController</h1>';
    }

}