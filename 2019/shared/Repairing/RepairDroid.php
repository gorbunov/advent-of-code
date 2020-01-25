<?php declare(strict_types=1);


namespace Repairing;


use IntCode\IntCodeRunner;

final class RepairDroid
{
    private const STATUS_WALL = 0;
    private const STATUS_MOVED = 1;
    private const STATUS_FOUND = 2;
    /**
     * @var IntCodeRunner
     */
    private $runner;
    /**
     * @var DroidController
     */
    private $controller;

    private function __construct(IntCodeRunner $runner, DroidController $controller, AreaMap $map)
    {
        $this->runner = $runner;
        $this->controller = $controller;
        $this->map = $map;
    }

    public static function create(string $program): RepairDroid
    {
        $map = AreaMap::create();
        $controller = DroidController::create();
        return new self(IntCodeRunner::fromCodeString($program, $controller), $controller, $map);
    }

    public function run(): self
    {
        do {
            $this->runner->untilOutput();
            $status = $this->status();
            $this->controller->status($status);
            printf("Movement status: %d\n", $status);
        } while ($status !== self::STATUS_FOUND);
        return $this;
    }

    private function status(): int
    {
        return $this->runner->program()->output()->pop();
    }
}
