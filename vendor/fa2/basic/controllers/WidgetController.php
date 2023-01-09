<?php

namespace fa2\basic\controllers;

use fa2\App;
use fa2\Cache;

class WidgetController extends Controller
{
    protected string $prefix_kebab = '';
    protected string $prefix_snake = '';
    protected string $widget_dir = '';


    public function __construct(public $dir, protected $widget_name, public $params = []){}

    public function run()
    {        
        self::init();
        $model_path = 'app\widgets\\' . $this->widget_name . '\Model';
        debug($model_path);
        if (class_exists($model_path)) {
            $model = new $model_path($this->widget_dir);
        } else {
            $model_path = 'fa2\basic\models\WidgetModel';
            $model = new $model_path($this->widget_dir);
        }
        $model->run();
    }

    public function render()
    {
        //$view_path = 'app\widgets\\' . $this->widget_name . '\Model';
    }

    protected function init()
    {
        $this->widget_dir = WIDGET . '/'. $this->widget_name;
        $this->prefix_kebab = 'w-' . $this->widget_name . '-';
        $this->prefix_snake = 'w_' . $this->widget_name . '_';
    }

    public function test($dir)
    {
        echo '<h1>'.WIDGET . '/'. $this->name.'</h1>';
    }

}
