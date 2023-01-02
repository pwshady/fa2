<?php

namespace fa2\basic\models;

use fa2\App;

class ModulModel extends Model
{
    public function __construct(public $dir){}

    public function run()
    {
        self::getSettings();
    }

    public function getSettings()
    {
        if (file_exists($this->dir . '/settings.json')) {           
            $settings = json_decode(file_get_contents($this->dir . '/settings.json'), true);
            if (is_array($settings)) {
                foreach ($settings as $key => $value) {
                    foreach ($value as $key => $value) {
                        App::$app->setSetting($key, $value);
                    }
                }
            }
        }
    }

    public function getLabels()
    {
        if (file_exists($this->dir . '/labels.json')) {            
            $labels = json_decode(file_get_contents($this->dir . '/labels.json'), true);
            if (is_array($labels)) {
                $language = App::$app->getLanguage()['code'];
                if (array_key_exists($language, $labels)) {
                    return $labels[$language];
                } else {
                    foreach ( $labels as $key => $value) {
                        return $value;
                    }
                }
            }
        }
    }
}