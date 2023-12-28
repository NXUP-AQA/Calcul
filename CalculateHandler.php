<?php

namespace liw;
use liw\interfaces\HandlerInterface;
use liw\dto\CalculatorDTO;
use liw\strategies\AdditionStrategy;
use liw\strategies\DivisionStrategy;
use liw\strategies\MultiplicationStrategy;
use liw\strategies\SubtractionStrategy;

class CalculateHandler implements HandlerInterface
{
    public $green = "\033[32m";
    public $yellow = "\033[33m";
    public $red = "\033[31m";
    public $blue = "\033[34m";
    public $reset = "\033[0m";
    private array $strategies;
    private array $failedActions;
    public function __construct()
    {
        $this->strategies = [
            new AdditionStrategy(),
            new SubtractionStrategy(),
            new MultiplicationStrategy(),
            new DivisionStrategy()
        ];
    }

    public function handle(CalculatorDTO $data): void
    {
        while ($data->operation !== 4) {
            $this->resetContext($data);
            shuffle($this->strategies);

            foreach ($this->strategies as $strategy) {
                if (!$strategy->apply($data)) {
                    $this->failedActions[] = $strategy->getDescription();
                }
            }
        }
        $this->render($data);
    }
    private function resetContext(CalculatorDTO $data): void
    {
        $data->argOne = $data->argOne ?? rand(1, 2000);
        $data->argTwoo = $data->argTwoo ?? rand(1, 2000);
        $data->operation = 0;
        $data->total = 0;
        $data->iteration++;
        $data->action = [];
        $data->logs = "лог выполнения:{$data->separator}";
    }
    private function renderFailedActions(CalculatorDTO $data): string
    {
        $failedActions = [];
        $count = 0;

        foreach ($this->failedActions as $failedAction) {
            $failedActions[] = $failedAction;

            if (++$count % 4 === 0) {
                $failedActions[] = $data->separator;
            }
        }
        return implode(" ", $failedActions);
    }
    private function render(CalculatorDTO $data): void
    {
        $outputFunctions = [
            'cli' => [
                'success' => fn() => $this->green . "Найдена удачная комбинация:" . $this->reset . " {$data->separator}",
                'action' => fn() => $this->green . "Последовательность действий:" . $this->reset . " {$data->separator}",
                'action_items' => fn() => $this->yellow . implode("  ", $data->action) . $this->reset . " {$data->separator}",
                'iteration' => fn() => $this->blue  . "Выполнено итераций: " . "{$data->iteration}$this->reset{$data->separator}",
                'failed_actions_header' => fn() => $this->yellow . "Неудачные комбинации:" . $this->reset . " {$data->separator}",
                'failed_actions' => fn() => $this->red . $this->renderFailedActions($data),
            ],
            'web' => [
                'success' => fn() => "Найдена удачная комбинация. {$data->separator}",
                'action' => fn() => "Последовательность действий. {$data->separator}",
                'action_items' => fn() => implode("  ", $data->action) . $data->separator,
                'iteration' => fn() => "Выполнено итераций {$data->iteration}{$data->separator}",
                'failed_actions_header' => fn() => "Неудачные комбинации {$data->separator}",
                'failed_actions' => fn() => $this->renderFailedActions($data),
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
    }
    

}
