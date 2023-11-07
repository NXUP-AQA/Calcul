<?php

use liw\controllers\CalculateControllers;
require_once __DIR__ . "/../vendor/autoload.php";

$separator = (php_sapi_name() === 'cli') ? "\n" : "<br>";

$cacl = new CalculateControllers();
$cacl->web($separator);















