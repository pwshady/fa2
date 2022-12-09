<?php

namespace fa2\basic\controllers;

class PageController extends Controller
{

    public string $controller = 'fa2\basic\controllers\PageController';

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
        echo '<br>Controller of dir: ' . $this->dir;
        $controller_path = str_replace('/', '\\', $this->dir) . 'MyPageController';
        if (class_exists($controller_path) && ($controller_path != '\\' . __CLASS__)) {
            $controller = new $controller_path($this->dir, $this->page);
            $controller->run();
        } else {
            self::getModel();
            if ($this->page) {
                if (is_dir(ROOT . $this->dir . $this->page[0])) {
                    $this->dir .= $this->page[0];
                    array_shift($this->page);
                    $controller = new $this->controller($this->dir, $this->page);
                    $controller->run();
                } else {
                    
                }
            } else {
                if (is_dir(ROOT . $this->dir . '_')){
                    echo '<br>=====gs';
                }
            }
        }
        //echo '<h1>PageNotFound</h1>';
    }

    public function puc()
    {

        if (class_exists($controller) && ($controller != '\\' . __CLASS__)) {
            echo '<br>=====jjk';
            new $controller($page, $dir, $request);
        } else {
            if ($page) {
                if (is_dir(ROOT . $dir . $page[0])) {
                    $dir .= $page[0];
                    array_shift($page);
                    new $this->controller($page, $dir);
                } else {
                    
                }
            } else {
                if (is_dir(ROOT . $dir . '_')){
                    echo '<br>=====gs';
                }
            }
        }

    }



}