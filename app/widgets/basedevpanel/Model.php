<?php

namespace app\widgets\basedevpanel;

use fa2\basic\models\ModulModel;

class Model extends ModulModel
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