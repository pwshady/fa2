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

}