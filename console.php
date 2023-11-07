<?php


use liw\dto\CalculatorDTO;
use liw\interface\CalculateHandler;

require_once __DIR__ . "/vendor/autoload.php";

if ($argc < 3) {
    die("Usage: php console.php <arg1> <arg2>\n" . PHP_EOL);
}


$arg1 = (int)$argv[1];
$arg2 = (int)$argv[2];


$data = new CalculatorDTO();
$data->arg1 = $arg1;
$data->arg2 = $arg2;


$handler = new CalculateHandler();


$handler->handle($data);

