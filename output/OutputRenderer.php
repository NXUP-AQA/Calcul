<?php

namespace liw\output;

use liw\dto\CalculatorDTO;
use liw\CalculateHandler;

class OutputRenderer 
{
    public $green = "\033[32m";
    public $yellow = "\033[33m";
    public $red = "\033[31m";
    public $blue = "\033[34m";
    public $reset = "\033[0m";
    public function renderOutput(CalculatorDTO $data, array $failedActions): void
    {
        $outputFunctions = [
            'cli' => [
                'success' => fn() => $this->green . "Найдена удачная комбинация:" . $this->reset . " {$data->separator}",
                'action' => fn() => $this->green . "Последовательность действий:" . $this->reset . " {$data->separator}",
                'action_items' => fn() => $this->yellow . implode("  ", $data->action) . $this->reset . " {$data->separator}",
                'iteration' => fn() => $this->blue  . "Выполнено итераций: " . "{$data->iteration}$this->reset{$data->separator}",
                'failed_actions_header' => fn() => $this->yellow . "Неудачные комбинации:" . $this->reset . " {$data->separator}",
                'failed_actions' => fn() => $this->red . $this->renderFailedActions($failedActions, $data->separator),
            ],
            'web' => [
                'success' => fn() => "Найдена удачная комбинация. {$data->separator}",
                'action' => fn() => "Последовательность действий. {$data->separator}",
                'action_items' => fn() => implode("  ", $data->action) . $data->separator,
                'iteration' => fn() => "Выполнено итераций {$data->iteration}{$data->separator}",
                'failed_actions_header' => fn() => "Неудачные комбинации {$data->separator}",
                'failed_actions' => fn() => $this->renderFailedActions($failedActions, $data->separator),
            ],
        ];

        $outputMode = php_sapi_name() === 'cli' ? 'cli' : 'web';

        echo $outputFunctions[$outputMode]['success']();
        echo "Число 1 - {$data->argOne}{$data->separator}";
        echo "Число 2 - {$data->argTwoo}{$data->separator}";
        echo $outputFunctions[$outputMode]['action']();
        echo $outputFunctions[$outputMode]['action_items']();
        echo $outputFunctions[$outputMode]['iteration']();
        echo $data->logs;
        echo $outputFunctions[$outputMode]['failed_actions_header']();
        echo $outputFunctions[$outputMode]['failed_actions']();

        echo $this->renderFailedActions($failedActions, $data->separator);
    }
    private function renderFailedActions(array $failedActions, string $separator): string
    {
        $result = '';
        $count = 0;
        $line = 4;

        foreach ($failedActions as $failedAction) {
            $result .= $failedAction . ' ';
            $count++;

            if ($count % $line === 0) {
                $result .= $separator;
            }
        }
   
        return $result;
    }
}
