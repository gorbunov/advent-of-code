<?php declare(strict_types=1);

namespace IntCode;

use Closure;
use IntCode\Program\Input;

class IntCodeComputer
{
    /**
     * @var Program
     */
    private $memory;

    private function __construct(Program $program)
    {
        $this->memory = $program;
    }

    public static function load(string $memory, Input $input): self
    {
        $opcodes = explode(',', $memory);
        $program = Program::createFromArray($opcodes, $input);
        return new self($program);
    }

    public function run(Closure $bootloader): Program
    {
        return $this->boot($bootloader)->run()->program();
    }

    private function boot(Closure $bootloader): IntCodeRunner
    {
        $program = $bootloader(clone $this->memory);
        return IntCodeRunner::fromProgram($program);
    }

}
