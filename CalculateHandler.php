<?php

namespace liw;
use liw\interfaces\HandlerInterface;
use liw\dto\CalculatorDTO;
use liw\strategies\AdditionStrategy;
use liw\strategies\DivisionStrategy;
use liw\strategies\MultiplicationStrategy;
use liw\strategies\SubtractionStrategy;
use liw\output\OutputRenderer;

class CalculateHandler implements HandlerInterface
{
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
        $output = new OutputRenderer();
        $output->renderOutput($data, $this->failedActions);
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
}
