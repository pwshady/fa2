<?php

namespace app\modules\basedb;

use fa2\traits as t;

class Controller 
{

    use t\TSingleton;

    protected string $modul_name = 'basedb';

    public function run()
    {
        return 1;
    }

    public function test()
    {
        return 'db';
    }

}