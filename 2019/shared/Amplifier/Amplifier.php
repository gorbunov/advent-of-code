<?php declare(strict_types=1);

namespace Amplifier;

use IntCode\IntCodeRunner;
use IntCode\Program\Input;
use IntCode\Program\Output;

final class Amplifier
{
    /**
     * @var IntCodeRunner
     */
    private $runner;
    /**
     * @var
     */
    private $phase;

    private function __construct(IntCodeRunner $runner)
    {
        $this->runner = $runner;
    }

    public static function create(string $program, Input $input, Output $output): Amplifier
    {
        return new self(IntCodeRunner::fromCodeString($program, $input, $output));
    }

    public function configure(int $phase): self
    {
        $this->phase = $phase;
        $this->runner->reset();
        $this->runner->program()->input()->reset();
        $this->runner->program()->output()->reset();

        $this->input()->insert($phase);
        return $this;
    }

    public function input(): Input
    {
        return $this->runner->program()->input();
    }

    public function run(int $signal): self
    {
        $this->input()->insert($signal);
        $this->runner->untilOutput();
        return $this;
    }

    public function output(): Output
    {
        return $this->runner->program()->output();
    }

    public function halted(): bool
    {
        return $this->runner->halted();
    }
}
