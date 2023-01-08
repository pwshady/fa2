<?php

namespace fa2\basic\controllers;

use fa2\App;
use fa2\Cache;

class ModulController extends Controller
{
    protected string $widget_name = '';
    protected string $prefix_kebab = '';
    protected string $prefix_snake = '';

    public function __construct(public $dir, public $params = []){}

    protected function init($dir)
    {
        $this->widget_name = self::getWidgetName($dir);
        $this->prefix_kebab = 'w-' . $this->widget_name . '-';
        $this->prefix_snake = 'w_' . $this->widget_name . '_';
    }

    protected function getWidgetName($dir)
    {
        $path_arr = explode('/', $dir);
        return $path_arr[count($path_arr) - 1];
    }

}
