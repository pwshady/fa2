<?php

namespace app\widgets\basedevauth;

class Model
{

    public function getUsers()
    {
        if (file_exists(__DIR__ . '/users.json')) {           
            $users = json_decode(file_get_contents(__DIR__ . '/users.json'), true);
            if (is_array($users)) {
                return $users;
            }
        }
        return [];
    }

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