<?php

namespace fa2;

use fa2\basic\controllers;

class Router
{

    protected static array $page = [];

    public static function dispatch($url)
    {
        $url = self::removeQueryString($url);
        self::getPage($url);
        if (file_exists(ROOT . '/app/pages/language.json')){
            self::getLanguage();
        }
        self::run();
    }

    protected static function removeQueryString($url)
    {
        if ($url) {
            $url_arr = explode('&', $url, 2);
            if (str_contains($url_arr[0], '=') === false) {
                return rtrim($url_arr[0], '/');
            }
        }
        return '';
    }

    protected static function getLanguage()
    {
        $language = json_decode(file_get_contents(ROOT . '/app/pages/language.json'), true);
        if (array_key_exists('base_language', $language)) {
            self::setLanguage($language['base_language']);
        }
        if (array_key_exists('type', $language)) {
            switch ($language['type']) {
                case 'prefix':
                    self::getPrefixLanguage($language);
                    break;
            }
        }
    }

    protected static function getPage($url)
    {
        self::$page = explode('/', $url);
    }

    protected static function run()
    {
        $controller = new basic\controllers\PageController('/app/pages', self::$page);
        $controller->run();
    }

    protected static function getPrefixLanguage($language)
    {
        if (array_key_exists('regex', $language)) {
            $regex = $language['regex'];
            if (array_key_exists('language', $language)) {
                $langs = $language['language'];
                preg_match($regex, self::$page[0], $prefix);
                if ($prefix) {
                    if (is_array($langs)) {
                        foreach ($langs as $key => $value) {
                            if ($prefix[0] === $key) {
                                self::setLanguage($value);
                                array_shift(self::$page);
                                return;
                            }
                        }
                    }
                }
            }
        }
    }

    protected static function setLanguage($lang)
    {
        if (self::validateLanguage($lang)) {
            App::$app->setLanguage($lang);
        }
    }

    protected static function validateLanguage($lang)
    {
        return true;
    }
}