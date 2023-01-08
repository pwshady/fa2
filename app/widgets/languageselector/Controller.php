<?php

namespace app\widgets\languageselector;

use fa2\basic\controllers\ModulController;

use fa2\App;

class Controller extends ModulController
{

    public array $languages = [];

    public function run()
    {
        self::init(__DIR__);
        $this->model = new Model(__DIR__);
        $this->model->run();
        if ( isset($this->params['code']) ) {    
            //Warning! No limit replase        
            $uri = str_replace( '/'. App::$app->getLanguage()['code'] . '/', '/' . $this->params['code']['value'] . '/', rtrim( $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'], '/' ));
            header('Location: ' . $uri );
            die;
        }
        if ( file_exists( PAGE . '/language.json' ) ) {
            $this->languages = $this->model->getLanguages();
        } else {
            echo 'languages not found';
        }
    }



    public function render()
    {
        $tec_language = App::$app->getLanguage()['code'];
        ob_start();
        require_once __DIR__ . '/indexView.php';
        return ob_get_clean();
    }

}
