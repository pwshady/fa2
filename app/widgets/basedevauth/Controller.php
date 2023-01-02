<?php

namespace app\widgets\basedevauth;

use fa2\basic\controllers\ModulController;

use fa2\App;

class Controller extends ModulController
{

    private $base_url = 'https://localhost/fa2/ru/';
    private $widget_name;
    private $prefix;
    private $condition;

    public function run()
    {
        $this->widget_name = self::getWidgetName(__DIR__);
        $this->prefix = 'w_' . $this->widget_name . '_';
        if ( isset($_SESSION[$this->prefix]['condition']) && $_SESSION[$this->prefix]['condition'] == 1 ){
            echo 'rrrrrrrrrrrrrrrrrrrrrrrr';

            $_SESSION[$this->prefix]['condition'] = 0;
            debug($_SESSION);
            die;
        }
        if ( isset($this->params['remember']['value']) ) {
            $_SESSION[$this->prefix]['remember'] = 'checked';
            $_SESSION[$this->prefix]['login'] = htmlspecialchars( $this->params['login']['value'] ) ?? '';
            $_SESSION[$this->prefix]['password'] = htmlspecialchars( $this->params['password']['value'] ) ?? '';
        } else {
            $_SESSION[$this->prefix]['remember'] = '';
            $_SESSION[$this->prefix]['login'] = '';
            $_SESSION[$this->prefix]['password'] = '';
        }
        if ( isset($this->params['login']['value']) ) {
            $users = [];
            $model = new Model();
            $users = $model->getUsers();
            if ( isset($users[$this->params['login']['value']]) ) {
                if ( isset($users[$this->params['login']['value']]['password']) && $users[$this->params['login']['value']]['password'] = $this->params['password']['value']) {
                    if ( isset($users[$this->params['login']['value']]['user_roles']) ) {
                        $_SESSION['user_roles'] = $users[$this->params['login']['value']]['user_roles'];
                        $_SESSION[$this->prefix]['condition'] = 1;
                    } else {
                        echo 'file is not correct';
                    }
                } else {
                    echo 'password is not correct';
                }
            } else {
                echo 'user not found';
            }
        
        }
        debug($_SESSION);
        //$session_key = $prefix . 'condition';
        //if ( array_key_exists($session_key, $_SESSION) ) {
        //    $this->condition = $_SESSION[$session_key];
        //} else {
        //    $this->condition = 0;
        //}

    }

    public function render()
    {
        $widget_name = self::getWidgetName(__DIR__);
        $model_path = 'fa2\basic\models\ModulModel';
        $model = new $model_path(__DIR__);
        $model->run();
        $labels = $model->getLabels();
        if ( array_key_exists('view', App::$app->getWidget($widget_name)) ) {
            $view_name = App::$app->getWidget(self::getWidgetName(__DIR__))['view'];
        } else {
            $view_name = 'mini';
        }
        switch ($view_name) {
            case 'form':
                return self::getFormHtml($labels);
                break;
            case 'mini':
                return self::getMiniHtml($labels);
                break;
            default:
                return 'loh';    
        }
    }

    public function getFormHtml($labels)
    {
        $login = $_SESSION[$this->prefix]['login'] ?? '';
        $password = $_SESSION[$this->prefix]['password'] ?? '';
        $remember = $_SESSION[$this->prefix]['remember'] ?? '';
        ob_start();
        require_once __DIR__ . '/formView.php';
        return ob_get_clean();
    }

    public function getMiniHtml($labels)
    {
        ob_start();
        require_once __DIR__ . '/miniView.php';
        return ob_get_clean();
    }



}