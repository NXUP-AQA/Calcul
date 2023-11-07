<?php

namespace liw\strategies;
use liw\dto\CalculatorDTO;


class AdditionStrategy implements CalculateStrategy
{
    public function apply(CalculatorDTO $data): void
    {
        if (in_array("сложение", $data->action, true) === false) {
            $data->operation++;
            $result = $data->total;
            $data->total = $data->arg1 + $data->arg2;
            $data->logs .= "Текущий результат " . $result . " $data->separator" . "Выполнено действие: сложение Результат: " . $data->total . " $data->separator";
        }
        $data->action[] = "сложение";
    }
    public function getDescription(): string
    {
        return "сложение";
    }
}
