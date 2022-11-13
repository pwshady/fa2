<?php

namespace fa2;

abstract class Controller 
{

    protected array $settings = [];

    protected function run(){}

    protected function getModel($page, $request){}

    protected function createView(){}

}
