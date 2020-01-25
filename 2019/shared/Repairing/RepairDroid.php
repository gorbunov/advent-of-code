<?php declare(strict_types=1);


namespace Repairing;


use IntCode\IntCodeRunner;

final class RepairDroid
{
    /**
     * @var IntCodeRunner
     */
    private $runner;
    /**
     * @var DroidController
     */
    private $controller;
    /**
     * @var AreaMap
     */
    private $map;

    private function __construct(IntCodeRunner $runner, DroidController $controller, AreaMap $map)
    {
        $this->runner = $runner;
        $this->controller = $controller;
        $this->map = $map;
    }

    public static function create(string $program): RepairDroid
    {
        $map = AreaMap::create();
        $controller = DroidController::create($map);
        return new self(IntCodeRunner::fromCodeString($program, $controller), $controller, $map);
    }

    public function run(): self
    {
        $status = 1;
        $step = 0;
        printf("Starting:\nState: %s\n", $this->controller);
        do {
            printf('Move: %s; ', Direction::name($this->controller->direction()));
            $step++;
            $this->runner->untilOutput();
            $status = $this->status();
            $this->controller->status($status);
            printf('Step: %3d; Status: %d:[%s] Now: %s', $step, $status, AreaMap::sprite($status), $this->controller);
        } while (($status !== AreaMap::FOUND) && $step < 20);
        return $this;
    }

    private function status(): int
    {
        return $this->runner->program()->output()->pop();
    }

    public function map(): AreaMap
    {
        return $this->map;
    }

}
