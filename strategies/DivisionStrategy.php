<?php

namespace liw\strategies;

use liw\dto\CalculatorDTO;


class DivisionStrategy implements CalculateStrategy
{
    public function apply(CalculatorDTO $data): void
    {
        if ($data->arg2 !== 0 && $data->total > 1000 && in_array("деление", $data->action, true) === false) {
            $data->operation++;
            $result = $data->total;
            $data->total = round($data->arg1 / $data->arg2);
            $data->logs .= "Текущий результат " . $result . " $data->separator" . "Выполнено действие: деление Результат: " .$data->total . " $data->separator";
        }
        $data->action[] = "деление";
    }
    public function getDescription(): string
    {
        return "деление";
    }
}