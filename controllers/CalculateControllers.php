<?php

namespace liw\controllers;

use liw\dto\CalculatorDTO;
use liw\CalculateHandler;

class CalculateControllers
{
    public function web($argOne = null, $argTwoo = null, $separator = "<br>")
    {
        $data = new CalculatorDTO($argOne, $argTwoo, $separator);
        $hand = new CalculateHandler();
        $hand->handle($data);
        return $data;
    }
}
