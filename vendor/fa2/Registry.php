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
        'header_strings' => [
            ['label' => '', 'string' => '']
        ],
        'footer_scripts' => [
            ['label' => '', 'type' => '', 'path' => '']
        ],
        'footer_strings_top' => [
            ['label' => '', 'string' => '']
        ],
        'footer_strings_bottom' => [
            ['label' => '', 'string' => '']
        ],
    ];

    protected static array $labels = [
        'p__' => 'label'
    ];


    protected static array $vidgets = [
        [
            'name' => '', 'complete' => false, 'code' => ''
        ],
        [
            'name' => 'test', 'complete' => false, 'code' => ''
        ]
    ];
    

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
                if (is_array($value)) {
                    self::$settings[$key][0] = $value;
                } else {
                self::$settings[$key] = $value;
                }
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

    public function setLabel($key, $value)
    {
        self::$labels[$key] = $value;
    }

    public function getLabel($key)
    {
        return self::$labels[$key] ?? null;
    }

    public function getLabels()
    {
        return self::$labels;
    }

    public function setVidget($name, $params)
    {
        $method = true;
        $pos = true;
        if (array_key_exists('method', $params)) {
            $method = $params['method'];
        }
        if (array_key_exists('pos', $params)) {
            $pos = $params['pos'];
        }
        if ($method) {
            if ($pos) {
                array_push(self::$vidgets, ['name' => $name, 'complete' => false, 'code' => '']);
            } else {
                array_unshift(self::$vidgets, ['name' => $name, 'complete' => false, 'code' => '']);
            }
        } else {
            $result = [];
            foreach (self::$vidgets as $vidget) {
                if ($name != $vidget['name']) {
                    array_push($result, $vidget);
                }                               
            }
            self::$vidgets = $result;
        }
    }

    public function getVidget($key)
    {
        return self::$vidgets[$key] ?? null;
    }

    public function getVidgets()
    {
        return self::$vidgets;
    }

}
