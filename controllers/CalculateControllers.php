<?php

namespace liw\controllers;

use liw\dto\CalculatorDTO;
use liw\interfaces\CalculateHandler;


class CalculateControllers
{
    public function web($arg1 = null, $arg2 = null, $separator = "<br>")
    {
        $data = new CalculatorDTO($arg1, $arg2, $separator);
        $hand = new CalculateHandler();
        $hand->handle($data);
        return $data;
    }
}
