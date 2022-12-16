<?php

namespace fa2\basic\models;

class Model
{
    public function __construct(public $dir)
    {

    }

    public function run(){}

    public function getAccess()
    {
        echo '<br>=LoadAccess: ' . $this->dir;
    }

    public function getSetting(){}

    public function getVidgets(){}

    public function getData(){}

    public function grtLabels(){}
}
