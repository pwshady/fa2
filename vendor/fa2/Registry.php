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
