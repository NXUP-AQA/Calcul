<?php

namespace liw\interface;
use liw\dto\CalculatorDTO;

interface HandlerInterface {
    public function handle(CalculatorDTO $data): void;
}

