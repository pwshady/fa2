<?php

namespace fa2;

class SinglePageController extends PageController
{

    public function __construct($page, $request)
    {
        $page_arr = explode('/', $page);
        $page_arr[count($page_arr) - 1] = '_' . $request;
        $this->run($page_arr, $request);
    }

    protected function getModel($page, $request)
    {
        $dir = implode('\\', $page);
        $model = 'app\pages' . $dir . '\\_Model';
        if (class_exists($model)) {
            new $model($page, $request);
        } else {
            $model = 'fa2\SinglePageModel';
            new $model($page, $request);
        }
    }

}
