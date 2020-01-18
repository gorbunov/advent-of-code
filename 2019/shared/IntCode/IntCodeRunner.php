<?php declare(strict_types=1);

namespace IntCode;

use IntCode\Program\Input;
use IntCode\Program\Output;
use IntCode\Program\SimpleInput;

class IntCodeRunner
{
    private const DEBUG = false;
    /**
     * @var Program
     */
    private $program;

    /**
     * IntCode constructor.
     *
     * @param Program $program
     */
    private function __construct(Program $program)
    {
        $this->program = $program;
    }

    public static function fromCodeString(string $code, Input $input, Output $output = null): self
    {
        $opcodes = explode(',', $code);
        $program = Program::createFromArray($opcodes, $input, $output);
        return self::fromProgram($program);
    }

    public static function fromProgram(Program $program): self
    {
        return new self($program);
    }

    public function run(): self
    {
        $step = 0;
        while ($this->program->running()) {
            $step++;
            $opcode = $this->program->opcode();
            if (self::DEBUG) {
                printf("Step: %d, Opcode: %s\n", $step, $opcode);
                printf("Program: %s\n", substr((string)$this->program, 0, 30));
            }
            $this->program = $opcode->apply();
        }
        return $this;
    }

    /**
     * @return Program
     */
    public function program(): Program
    {
        return $this->program;
    }
}
