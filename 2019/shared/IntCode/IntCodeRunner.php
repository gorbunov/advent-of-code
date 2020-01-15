<?php declare(strict_types=1);

namespace IntCode;

class IntCodeRunner
{
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

    public static function fromString($program): self
    {
        $opcodes = explode(',', $program);
        $program = Program::createFromArray($opcodes);
        return self::fromProgram($program);
    }

    public static function fromProgram(Program $program): self
    {
        return new self($program);
    }

    public function run(): self
    {
        while ($this->program->running()) {
            $opcode = $this->program->opcode();
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
