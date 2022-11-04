<?php

namespace fa2;

class MultiPageController extends PageController
{

    public function __construct($page, $request, $params)
    {
        $this->run(PAGE . $page . '__/');
    }

}