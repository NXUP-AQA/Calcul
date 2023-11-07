<?php

namespace liw\strategies;
use liw\dto\CalculatorDTO;


class MultiplicationStrategy implements CalculateStrategy
{
    public function apply(CalculatorDTO $data): void
    {
        if ($data->total > 10 && in_array("умножение", $data->action, true) === false) {
            $data->operation++;
            $result = $data->total;
            $data->total = $data->arg1 * $data->arg2;
            $data->logs .= "Текущий результат " . $result . " $data->separator" . "Выполнено действие: умножение Результат: " . $data->total . " $data->separator";
        }
        $data->action[] = "умножение";
    }
    public function getDescription(): string
    {
        return "умножение";
    }
}