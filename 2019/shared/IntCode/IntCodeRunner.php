<?php declare(strict_types=1);

namespace IntCode;

use IntCode\Program\Input;

class IntCodeRunner
{
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

    public static function fromCodeString(string $code, Input $input): self
    {
        $opcodes = explode(',', $code);
        $program = Program::createFromArray($opcodes, $input);
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
            printf("Step: %d, Opcode: %s\n", $step, $opcode);
            $this->program = $opcode->apply($this->program);
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
