<?php

namespace liw\dto;
class CalculatorDTO
{
    public ?int $arg1;
    public ?int $arg2;
    public ?string $separator;
    public int $iteration = 0;
    public array $action;
    public int $operation = 0;
    public int $total;
    public string $logs;

    public function __construct()
    {
        $this->arg1 = null;
        $this->arg2 = null;
        $this->separator = (php_sapi_name() === 'cli') ? "\n" : "<br>";
    }
}
