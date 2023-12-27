<?php

namespace liw\interfaces;
use liw\dto\CalculatorDTO;

interface HandlerInterface {
    public function handle(CalculatorDTO $data): void;
}

