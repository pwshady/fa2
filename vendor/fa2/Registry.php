<?php

namespace fa2;

class Registry

{

    use traits\TSingleton;

    protected static string $language = 'en';
    protected static array $userRoles = [];
    
    protected static array $properties = [];

    public function setLanguage($language)
    {
        self::$language = $language;
    }

    public function getLanguage(): string
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

    public function getProperty($key)
    {
        return self::$properties[$key] ?? null;
    }

    public function getPropertys(): array
    {
        return self::$properties;
    }

}
