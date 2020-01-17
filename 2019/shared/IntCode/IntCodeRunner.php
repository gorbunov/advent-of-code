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
        while ($this->program->running()) {
            $this->program = $this->program->opcode()->apply($this->program);
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
