<?php

namespace app\widgets\basedevpanel;

use fa2\basic\controllers\WidgetController;

use fa2\App;

class Controller extends WidgetController
{




    public function render()
    {
        //$widgets = self::getWidgets();
        //$w_languageselector = $widgets['w_languageselector'];
        $html = [];
        ob_start();
        require_once __DIR__ . '/indexView.php';
        $html[0] = ob_get_clean();
        $html[1] = '<h1>testtttt</h1>';
        return $html;
    }


}
