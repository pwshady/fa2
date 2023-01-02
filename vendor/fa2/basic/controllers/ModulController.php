<?php

namespace fa2\basic\controllers;

use fa2\App;
use fa2\Cache;

class ModulController extends Controller
{

    public function __construct(public $dir, public $params = []){}

    public function getWidgetName($dir)
    {
        $path_arr = explode('/', $dir);
        return $path_arr[count($path_arr) - 1];
    }

}
