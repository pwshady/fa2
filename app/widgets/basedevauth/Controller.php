<?php

namespace app\widgets\basedevauth;

use fa2\basic\controllers\ModulController;

use fa2\App;

class Controller extends ModulController
{
    private $auth_url;
    private $base_url;
    private $condition;

    public function run()
    {
        self::init(__DIR__);
        $this->model = new Model(__DIR__);
        $this->model->run();
        $this->base_url = str_replace('..', App::$app->getLanguage()['code'], $this->model->getConfig(__DIR__, 'base_url'));
        if ( isset($this->params['exit']) ) {            
            $_SESSION['user_roles'] = [];
            unset( $_SESSION[$this->prefix_kebab]['condition'] );
            header('Location: ' . $this->base_url );
            die;
        }
        //=====================================
        if ( isset($_SESSION[$this->prefix_kebab]['condition']) && $_SESSION[$this->prefix_kebab]['condition'] == 1 )
        {
            if ( rtrim($this->base_url, '/') == rtrim( $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'], '/' ) ) {
                $this->auth_url = str_replace('..', App::$app->getLanguage()['code'], $this->model->getConfig(__DIR__, 'auth_url'));
                header('Location: ' . $this->auth_url );
                die;
            }
        }
        //============================================
        if ( isset($this->params['remember']['value']) ) {
            $_SESSION[$this->prefix_kebab]['remember'] = 'checked';
            $_SESSION[$this->prefix_kebab]['login'] = htmlspecialchars( $this->params['login']['value'] ) ?? '';
            $_SESSION[$this->prefix_kebab]['password'] = htmlspecialchars( $this->params['password']['value'] ) ?? '';
            
        } else {
            if( !empty( $this->params ) ) {
                if ( !isset($this->params['remember']) ) {
                    $_SESSION[$this->prefix_kebab]['remember'] = '';
                    $_SESSION[$this->prefix_kebab]['login'] = '';
                    $_SESSION[$this->prefix_kebab]['password'] = '';
                }
            }
        }
        if ( isset($this->params['login']['value']) ) {
            $users = [];
            $users = $this->model->getUsers();
            if ( isset($users[$this->params['login']['value']]) ) {
                if ( isset($users[$this->params['login']['value']]['password']) && $users[$this->params['login']['value']]['password'] == $this->params['password']['value']) {
                    if ( isset($users[$this->params['login']['value']]['user_roles']) ) {
                        $_SESSION['user_roles'] = $users[$this->params['login']['value']]['user_roles'];
                        $_SESSION[$this->prefix_kebab]['condition'] = 1;
                        $this->auth_url = str_replace('..', App::$app->getLanguage()['code'], $this->model->getConfig(__DIR__, 'auth_url'));
                        header('Location: ' . $this->auth_url );
                        die;
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
    }

    public function render()
    {
        $labels = $this->model->getLabels();
        if ( array_key_exists('view', App::$app->getWidget($this->widget_name)) ) {
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
        $login = $_SESSION[$this->prefix_kebab]['login'] ?? '';
        $password = $_SESSION[$this->prefix_kebab]['password'] ?? '';
        $remember = $_SESSION[$this->prefix_kebab]['remember'] ?? '';
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
