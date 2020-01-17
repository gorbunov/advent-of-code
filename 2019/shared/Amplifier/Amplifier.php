<?php declare(strict_types=1);

namespace Amplifier;

use IntCode\IntCodeRunner;
use IntCode\Program\Input;

final class Amplifier
{
    /**
     * @var IntCodeRunner
     */
    private $runner;
    /**
     * @var Input
     */
    private $input;

    private function __construct(IntCodeRunner $runner)
    {
        $this->runner = $runner;
    }

    public static function create(string $program, int $phase, int $signal): Amplifier
    {
        $input = Input::create([$phase, $signal]);
        return new self(IntCodeRunner::fromCodeString($program, $input));
    }

    public function run(): int
    {
        return  $this->runner->run()->program()->output()->outputs()[0];
    }
}
