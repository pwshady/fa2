<?php

namespace fa2\basic\controllers;

use fa2\App;
use fa2\Cache;

class PageController extends Controller
{

    public string $controller_path = 'fa2\basic\controllers\PageController';

    public function __construct(public $dir, public $page){}

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
                if (is_dir(ROOT . $this->dir . $this->page[0]) && ($this->page[0] != '_')) {
                    $this->dir .= $this->page[0];
                    array_shift($this->page);
                    $controller = new $this->controller_path($this->dir, $this->page);
                    $controller->run();
                } else {
                    if (is_dir(ROOT . $this->dir . '__')) {
                        $controller_path = str_replace('/', '\\', $this->dir) . '__\MyMultiPageController';
                        if (class_exists($controller_path) && ($controller_path != '\\' . __CLASS__)) {
                            $controller = new $controller_path($this->dir . '__/', []);
                            array_shift($this->page);
                            $controller->run();
                        } else {
                            $controller_path = 'fa2\basic\controllers\MultiPageController';
                            $controller = new $controller_path($this->dir . '__/', []);
                            array_shift($this->page);
                            $controller->run();
                        }
                    } else {
                        $controller = new PageController('/vendor/fa2/pages', ['errors', '404']);
                        $controller->run();
                    }                  
                }
            } else {
                self::job();
                if (is_dir(ROOT . $this->dir . '_')){
                    $controller_path = str_replace('/', '\\', $this->dir) . '_\MySinglePageController';
                    if (class_exists($controller_path) && ($controller_path != '\\' . __CLASS__)) {
                        $controller = new $controller_path($this->dir . '_/', []);
                        array_shift($this->page);
                        $controller->run();
                    } else {
                        $controller_path = 'fa2\basic\controllers\SinglePageController';
                        $controller = new $controller_path($this->dir . '_/', []);
                        array_shift($this->page);
                        $controller->run();
                    }
                } else {
                    if (is_dir(ROOT . $this->dir . '__')) {
                        $controller_path = str_replace('/', '\\', $this->dir) . '__\MyMultiPageController';
                        if (class_exists($controller_path) && ($controller_path != '\\' . __CLASS__)) {
                            $controller = new $controller_path($this->dir . '__/', []);
                            array_shift($this->page);
                            $controller->run();
                        } else {
                            $controller_path = 'fa2\basic\controllers\MultiPageController';
                            $controller = new $controller_path($this->dir . '__/', []);
                            array_shift($this->page);
                            $controller->run();
                        }
                    }  else {
                        $controller = new PageController('/vendor/fa2/pages', ['errors', '404']);
                        $controller->run();
                    } 
                }     
            }  
        }
    }

    public function job()
    {
        self::runModel();
        self::getAccess();
    }

    public function getAccess()
    {
        $access = App::$app->getAccess();
        $user_roles = [];
        if (array_key_exists('user_roles', $_SESSION)) {
            $user_roles = $_SESSION['user_roles'];
        }
        foreach ($access as $value) {
            if (!in_array($value, $user_roles)) {
                $controller = new PageController('/vendor/fa2/pages', ['errors', '500']);
                $controller->run();
            }
        }
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

    public function render($view)
    {
        $html = '';
        $html .= self::headerCreate();
        $html .= $view . PHP_EOL;
        $html .= self::footerCreate();
        return $html;
    }

    public function headerCreate()
    {
        $header_html = '<!doctype html>' . PHP_EOL;
        $header_html .= '<html lang="' . App::$app->getLanguage()['code'] . '">' . PHP_EOL;
        $header_html .= '<head>' . PHP_EOL;
        $title = App::$app->getLabel(App::$app->getSetting('title')) ?? App::$app->getSetting('title');
        $header_html .= $title ? '<title>' . $title . '</title>' . PHP_EOL : '';
        $charset = App::$app->getSetting('charset');
        $header_html .= $charset ? '<meta charset="' . $charset . '">' . PHP_EOL : '';
        $keywords = App::$app->getLabel(App::$app->getSetting('keywords')) ?? App::$app->getSetting('keywords');
        $header_html .= $keywords ? '<meta name="keywords" content="' . $keywords . '">' . PHP_EOL : '';
        $description = App::$app->getLabel(App::$app->getSetting('description')) ?? App::$app->getSetting('description');
        $header_html .= $description ? '<meta name="description" content="' . $description . '">' . PHP_EOL : '';
        $header_html .= self::createStrings('header_strings');
        $header_html .= self::createStyles();
        $header_html .= self::createScripts('header_scripts');
        $header_html .= '</head>' . PHP_EOL;
        return $header_html;
    }

    public function footerCreate()
    {
        $footer_html = '<footer>' . PHP_EOL;
        $footer_html .= self::createStrings('footer_strings_top');
        $footer_html .= self::createScripts('footer_scripts');
        $footer_html .= self::createStrings('footer_strings_bottom');
        $footer_html .= '</footer>' . PHP_EOL;
        $footer_html .= '</html>' . PHP_EOL;
        return $footer_html;
    }

    public function createStrings($key)
    {
        $html = '';
        if (App::$app->getSetting($key)) {
            foreach (App::$app->getSetting($key) as $string) {
                $html .= $string['string'] ? $string['string'] . PHP_EOL : '';
            }
        }
        return $html;
    }

    public function createStyles()
    {
        $html = '';
        if (App::$app->getSetting('styles')) {
            foreach (App::$app->getSetting('styles') as $string) {
                $type = array_key_exists('type', $string) ? $string['type'] : '';
                switch ($type){
                    case 'css':
                        $html .= self::getCss($string);
                        break;
                }
            }
        }
        return $html;
    }

    public function getCss($string)
    {
        $rel = array_key_exists('rel', $string) ? $string['rel'] : 'stylesheet';
        $media = array_key_exists('media', $string) ? $string['media'] : 'all';
        $href = array_key_exists('href', $string) ? $string['href'] : '';
        return '<link type="text/css" rel="' . $rel . '" media="' . $media . '" href="' . $href . '" />' . PHP_EOL;
    }

    public function createScripts($key)
    {
        $html = '';
        if (App::$app->getSetting($key)) {
            foreach (App::$app->getSetting($key) as $string) {
                $type = array_key_exists('type', $string) ? $string['type'] : '';
                switch ($type){
                    case 'js':
                        $html .= self::getJs($string);
                        break;
                }
            }
        }
        return $html;
    }

    public function getJs($string)
    {
        $href = array_key_exists('href', $string) ? $string['href'] : '';
        return '<script src="' . $href . '"></script>' . PHP_EOL;
    }

    public function createdWidgets()
    {
        $widgets = (App::$app->getWidgets());
        foreach ( $widgets as $widget ) {
            if ( array_key_exists('name', $widget) ) {
                $params = self::getParams('w_' . $widget['name'] . '_');
                if ( array_key_exists('cache', $widget) ) {
                    if ( empty($params) ) {
                        $file_name = 'w_' . App::$app->getLanguage()['code'] . '_' . $widget['name'];
                        $cache = Cache::getInstance();
                        $html = $cache->get($file_name);
                        if ( $html ) {
                            $widget['code'] = $html;
                            $widget['complete'] = 1;
                            App::$app->updateWidget($widget);
                        } else {
                            self::createdWidget($widget, $params);
                            $cache->set($file_name, App::$app->getWidget($widget['name'])['code'], $widget['cache']);
                        }
                    } else {
                        self::createdWidget($widget, $params);
                    }
                } else {
                    self::createdWidget($widget, $params);
                }                   
            } else {
                echo 'setting error' . PHP_EOL;
            }
        }
    }

    public function createdWidget($widget, $params)
    {
        $controller_path = 'app\widgets\\' . $widget['name'] . '\Controller';
        if ( class_exists($controller_path) ) {
            $controller = new $controller_path($this->dir, $params);
            if (method_exists($controller, 'run')) {
                $controller->run();
            }
            if (method_exists($controller, 'render')) {
                $widget['code'] = $controller->render();
            }
            $widget['complete'] = 1;
            App::$app->updateWidget($widget);
        } else {
            echo 'widget error' . PHP_EOL;
        }
    }

    public function createdView($view_name)
    {
        if (App::$app->getSetting('cache')) {

            $cache = Cache::getInstance();
            $file_name = 'p_'. App::$app->getLanguage()['code'] . str_replace('/', '_', $this->dir) . $view_name;
            $html = $cache->get($file_name);
            if ( $html ) {
                return $html;
            }
            self::createdWidgets();
            $view_path = 'fa2\basic\views\PageView';
            $view = new $view_path($this->dir, $view_name);
            $view->run();
            $html = self::render($view->render());
            $cache->set($file_name, $html, App::$app->getSetting('cache'));
            return $html;
        }
        self::createdWidgets();
        $view_path = 'fa2\basic\views\PageView';
        $view = new $view_path($this->dir, $view_name);
        $view->run();
        return self::render($view->render());
    }

    public function getParams($name)
    {
        $params = [];
        foreach ( $_GET as $key => $value ) {
            if ( str_starts_with($key, $name ) ) {
                $key_arr = explode('_', $key, 3);
                $params[$key_arr[2]] = ['value' => $value, 'method' => 'GET'];
            }
        }
        foreach ( $_POST as $key => $value ) {
            if ( str_starts_with($key, $name ) ) {
                $key_arr = explode('_', $key, 3);
                $params[$key_arr[2]] = ['value' => $value, 'method' => 'POST'];
            }
        }
        return $params;
    }
}