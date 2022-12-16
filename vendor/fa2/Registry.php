<?php

namespace fa2;

class Registry

{

    use traits\TSingleton;

    protected static array $language = [
        "code" => "en",
        "name" => "England"
    ];
    protected static array $userRoles = [];
    
    protected static array $properties = [];
    

    public function setLanguage($language)
    {
        self::$language = $language;
    }

    public function getLanguage(): array
    {
        return self::$language;
    }

    public function setUserRoles($userRoles)
    {
        self::$userRoles = $userRoles;
    }

    public function getUserRoles(): array
    {
        return self::$userRoles;
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
