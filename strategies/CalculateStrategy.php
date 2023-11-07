<?php

namespace liw\strategies;

use liw\dto\CalculatorDTO;

interface CalculateStrategy
{
    public function apply(CalculatorDTO $data): void;
}