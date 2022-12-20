<?php

if (PHP_MAJOR_VERSION < 8) {
    echo 'Php version less than 8';
    die;
}

require_once dirname(__DIR__) . '/config/init.php';
require_once FUNC . '/debug.php';

session_start();
$_SESSION['user_roles'] = ['admin'];
new \fa2\App();

//throw new Exception('Error');
echo '<br>===========ok';