<?php

namespace app\widgets\languageselector;

use fa2\basic\controllers\ModulController;

use fa2\App;

class Controller extends ModulController
{

    public array $languages = [];

    public function run()
    {
        if ( file_exists( PAGE . '/language.json' ) ) {
            $model = new Model;
            $this->languages = $model->getLanguages();
        } else {
            echo 'languages not found';
        }
    }



    public function render()
    {

        ob_start();
        require_once __DIR__ . '/indexView.php';
        return ob_get_clean();
    }

}
