<?php

namespace fa2;

class Registry

{

    use traits\TSingleton;

    protected static array $language = [
        'code' => 'en',
        'name' => 'England'
    ];
    protected static array $userRoles = [];
    
    protected static array $errors = [
        '404' => 'aaaaaaa',
        '500' => 'aaaaaaa',
    ];

    protected static array $settings = [
        'title' => '',
        'styles' => [
            ['label' => '', 'type' => '', 'path' => ''],
            ['label' => 'test', 'type' => '', 'path' => '']
        ],
        'header_scripts' => [
            ['label' => '', 'type' => '', 'path' => '']
        ],
        'header_string' => [
            ['label' => '', 'string' => '']
        ],
        'footer_scripts' => [
            ['label' => '', 'type' => '', 'path' => '']
        ],
        'footer_string_top' => [
            ['label' => '', 'string' => '']
        ],
        'footer_string_bottom' => [
            ['label' => '', 'string' => '']
        ],
    ];

    protected static array $vidgets = [];

    protected static array $labels = [];
    

    public function setLanguage($language)
    {
        self::$language = $language;
    }

    public function getLanguage(): array
    {
        return self::$language;
    }

    public function addAccess($value)
    {
        array_push(self::$userRoles, $value);
    }

    public function getAccess(): array
    {
        return self::$userRoles;
    }

    public function setError($key, $value)
    {
        self::$errors[$key] = $value;
    }

    public function getError($key)
    {
        return self::$errors[$key] ?? null;
    }

    public function getErrors()
    {
        return self::$errors;
    }

    public function setSetting($key, $value)
    {
        $method = 0;
        $pos = true;
        if (is_array($value)) {
            if (array_key_exists('method', $value)) {
                $method = $value['method'];
            }
        }
        if (is_array($value)) {
            if (array_key_exists('pos', $value)) {
                $pos = $value['pos'];
            }
        }
        switch ($method) {
            case 0:
                self::$settings[$key] = $value;
                break;
            case 1:
                if ($pos) {
                    array_push(self::$settings[$key], $value);
                } else {
                    array_unshift(self::$settings[$key], $value);
                }       
                break;
            case -1:
                if (is_array($value)) {
                    if (array_key_exists('label', $value)) {
                        $label = $value['label'];
                        $result = [];
                        foreach (self::$settings[$key] as $v) {
                            if (array_key_exists('label', $v)) {
                                if ($label != $v['label']) {
                                    array_push($result, $v);
                                }                               
                            } else {
                                array_push($result, $value);
                            }
                        }
                        self::$settings[$key] = $result;
                        break;
                    } 
                }
                self::$settings[$key] = null;
                break;
        }       
    }

    public function getSetting($key)
    {
        return self::$settings[$key] ?? null;
    }

    public function getSettings()
    {
        return self::$settings;
    }

    public function setVidget(){}

    public function setLabel(){}





    public function setProperty($key, $value)
    {
        self::$properties[$key] = $value;
    }

    public function addProperty($key, $value)
    {
        if (array_key_exists($key, self::$properties)) {
            self::$properties[$key] = array_merge(self::$properties[$key], $value);
        } else {
            self::$properties[$key] = $value;
        }
    }

    public function getProperty($key)
    {
        return self::$properties[$key] ?? null;
    }

    public function getProperties(): array
    {
        return self::$properties;
    }

}
