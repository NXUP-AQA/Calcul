<?php

namespace liw\dto;
class CalculatorDTO
{
    public ?int $argOne;
    public ?int $argTwoo;
    public ?string $separator;
    public int $iteration = 0;
    public array $action;
    public int $operation = 0;
    public int $total;
    public string $logs;

    public function __construct(?string $customSeparator = null)
    {
        $this->argOne = null;
        $this->argTwoo = null;
        $this->separator = $customSeparator;
    }
}
