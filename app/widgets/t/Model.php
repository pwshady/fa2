<?php

namespace app\widgets\basedevauth;

use fa2\basic\models\WidgetModel;

class Model extends WidgetModel
{



    public function getConfig($dir, $key)
    {
        if (file_exists($dir . '/configs.json')) {           
            $configs = json_decode(file_get_contents($dir . '/configs.json'), true);
            if ( isset($configs[$key]) ) {
                $value = $configs[$key];
                return $value;
            }
        }
        return [];
    }

}