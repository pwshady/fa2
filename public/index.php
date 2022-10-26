<?php

if (PHP_MAJOR_VERSION < 8) {
    echo 'Php version less than 8';
    die;
}

require_once dirname(__DIR__) . '/config/init.php';

new \fa2\App();

\fa2\App::$app->setLanguage('ru');
$s = \fa2\App::$app->getLanguage();

echo $s;
