<?php

namespace app\modules\languageselector;

use fa2\traits as t;

class Controller 
{

    use t\TSingleton;
    
    protected string $modul_name = 'languageselector';

    public function run()
    {
        return 1;
    }

    public function test()
    {
        return 'testaa';
    }

}