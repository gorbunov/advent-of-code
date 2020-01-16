<?php declare(strict_types=1);

namespace IntCode;

class IntCodeRunner
{
    private $program;
    /**
     * @var int
     */
    private $input;
    /**
     * @var int
     */
    private $output;

    /**
     * IntCode constructor.
     *
     * @param Program $program
     * @param int     $input
     * @param int     $output
     */
    private function __construct(Program $program, int $input, int $output)
    {
        $this->program = $program;
        $this->input = $input;
        $this->output = $output;
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
