<?php

namespace liw\strategies;

use liw\dto\CalculatorDTO;


class SubtractionStrategy implements CalculateStrategy
{
    public function apply(CalculatorDTO $data): void
    {
        if ($data->total < 1000 && in_array("вычитание", $data->action, true) === false) {
            $data->operation++;
            $result = $data->total;
            $data->total = $data->argOne - $data->argTwoo;
            $data->logs .= "Текущий результат "
                . $result . " $data->separator"
                . "Выполнено действие: вычитание Результат: " . $data->total . " $data->separator";
        }
        $data->action[] = "вычитание";
    }
    public function getDescription(): string
    {
        return "вычитание";
    }
}