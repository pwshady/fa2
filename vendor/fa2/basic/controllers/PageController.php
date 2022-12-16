<?php

namespace fa2\basic\controllers;

use fa2\App;

class PageController extends Controller
{

    public string $controller_path = 'fa2\basic\controllers\PageController';

    public function __construct(public $dir, public $page)
    {

    }

    public function run()
    {
        self::getController();
    }

    public function getController()
    {
        if ($this->page && !$this->page[0]) {
            array_shift($this->page);
        }
        $this->dir .= '/';
        $controller_path = str_replace('/', '\\', $this->dir) . 'MyPageController';
        if (class_exists($controller_path) && ($controller_path != '\\' . __CLASS__)) {
            $controller = new $controller_path($this->dir, $this->page);
            $controller->run();
        } else {
            if ($this->page) {
                self::job();
                if (is_dir(ROOT . $this->dir . $this->page[0])) {
                    $this->dir .= $this->page[0];
                    array_shift($this->page);
                    $controller = new $this->controller_path($this->dir, $this->page);
                    $controller->run();
                } else {
                    if (is_dir(ROOT . $this->dir . '__')) {
                        $controller_path = str_replace('/', '\\', $this->dir) . '__\MyMultiPageController';
                        if (class_exists($controller_path) && ($controller_path != '\\' . __CLASS__)) {
                            $controller = new $controller_path($this->dir . '__', []);
                            array_shift($this->page);
                            $controller->run();
                        } else {
                            $controller_path = 'fa2\basic\controllers\MultiPageController';
                            $controller = new $controller_path($this->dir . '__', []);
                            array_shift($this->page);
                            $controller->run();
                        }
                    } else {
                        echo '<h1>PageNotFound1</h1>';
                    }                  
                }
            } else {
                if (is_dir(ROOT . $this->dir . '_')){
                    $controller_path = str_replace('/', '\\', $this->dir) . '_\MySinglePageController';
                    if (class_exists($controller_path) && ($controller_path != '\\' . __CLASS__)) {
                        $controller = new $controller_path($this->dir . '_', []);
                        array_shift($this->page);
                        $controller->run();
                    } else {
                        $controller_path = 'fa2\basic\controllers\SinglePageController';
                        $controller = new $controller_path($this->dir . '_', []);
                        array_shift($this->page);
                        $controller->run();
                    }
                } else {
                    echo '<h1>PageNotFound2</h1>';
                }       
            }  
        }
    }

    public function job()
    {
        self::runModel();
    }

    public function runModel()
    {
        $model_path = str_replace('/', '\\', $this->dir) . 'MyPageModel';
        if (class_exists($model_path)) {
            $model = new $model_path($this->dir);
            $model->run();
        } else {
            $model_path = 'fa2\basic\models\PageModel';
            $model = new $model_path($this->dir);
            $model->run();
        }

    }

    public function render()
    {
        echo '<h1>Render</h1>';
        debug(App::$app->getLanguage());
    }



}