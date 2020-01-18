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
        return $this;
    }

    public function run(/*int $phase, */int $signal): self
    {
        $this->input()->insert($this->phase)->insert($signal);
        $this->runner->run();
        return $this;
    }

    public function input(): Input
    {
        return $this->runner->program()->input();
    }

    public function output(): Output
    {
        return $this->runner->program()->output();
    }
}
