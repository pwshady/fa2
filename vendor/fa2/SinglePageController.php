<?php

namespace fa2;

class SinglePageController extends PageController
{

    public function __construct($page, $request, $params)
    {
        $this->run(PAGE . $page . '_/_' . $request);
    }

}
