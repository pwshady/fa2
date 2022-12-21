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
                        echo '<h1>PageNotFound1</h1>';
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
                echo 'Access Denide';
                die;
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
        echo $html;
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

}