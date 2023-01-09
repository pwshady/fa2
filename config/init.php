<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));

#Core constants
define("CORE", ROOT . '/vendor/fa2');
define("TRAIT", CORE . '/traits');
define("FUNC", CORE . '/func');

#App constants
define("APP", ROOT . '/app');
define("PAGE", APP . '/pages');
define("WIDGET", APP . '/widgets');

#Config constants
define("CONFIG", ROOT . '/config');

#Public constants
define("PUBLIC", ROOT . '/public');

#Tmp constants
define("TMP", ROOT . '/tmp');

define("CACHE", TMP . '/cache');
define("LOGS", TMP . '/logs');

require_once ROOT . '/vendor/autoload.php';

//tt
