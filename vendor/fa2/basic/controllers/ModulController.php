<?php

namespace fa2\basic\controllers;

use fa2\App;
use fa2\Cache;

class ModulController extends Controller
{
    protected string $widget_name = '';
    protected string $prefix_kebab = '';
    protected string $prefix_snake = '';


    public function __construct(public $dir, public $name, public $params = []){}

    public function run()
    {
        $dir = WIDGET . '/'. $this->name;
        self::init($dir);
        $model_path = 'app\widgets\\' . $this->name . '\Model';
        debug($model_path);
        if (class_exists($model_path)) {
            $model = new $model_path($dir);
        } else {

        }
        $model->run();
    }

    public function render()
    {

    }

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

    public function test($dir)
    {
        echo '<h1>'.WIDGET . '/'. $this->name.'</h1>';
    }

}
