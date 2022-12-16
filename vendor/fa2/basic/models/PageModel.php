<?php

namespace fa2\basic\models;

class PageModel extends Model
{
    public function __construct(public $dir)
    {

    }

    public function run()
    {
        echo '<br>=RunModel: ' . $this->dir;
        self::getAccess();
    }

}