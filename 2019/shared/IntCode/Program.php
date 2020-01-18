<?php declare(strict_types=1);

namespace IntCode;

use IntCode\Opcode\Mode;
use IntCode\Opcode\Opcode;
use IntCode\Program\Input;
use IntCode\Program\Output;
use IntCode\Opcode\Factory;

class Program
{
    /**
     * @var array<int>
     */
    private $program;
    private $position = 0;
    private $halted = false;

    /**
     * @var Input
     */
    private $input;
    /**
     * @var Output
     */
    private $output;

    /**
     * Program constructor.
     *
     * @param array  $program
     * @param Input  $input
     * @param Output $output
     */
    private function __construct(array $program, Input $input, Output $output)
    {
        $this->program = $program;
        $this->input = $input;
        $this->output = $output;
    }

    public static function createFromArray(array $program, Input $input, ?Output $output = null): Program
    {
        $program = array_map('\intval', $program);
        $output = $output ?? Program\OutputFactory::create();
        return new self($program, $input, $output);
    }

    public function advance(int $size): self
    {
        $this->position += $size;
        return $this;
    }

    public function jumpTo(int $position): self
    {
        $this->position = $position;
        return $this;
    }

    public function read(int $argument, int $mode = Mode::POSITION): int
    {
        return ($mode === Mode::POSITION) ? $this->readAtPosition($argument) : $argument;
    }

    private function readAtPosition(int $position): int
    {
        return $this->program[$position];
    }

    public function readAhead(int $count): array
    {
        return \array_slice($this->program, $this->position, $count);
    }

    public function current(): int
    {
        return $this->program[$this->position];
    }

    public function alter(int $position, int $value, int $mode = Mode::POSITION): self
    {
        $this->program[$position] = $value;
        return $this;
    }

    public function halt(): self
    {
        $this->halted = true;
        return $this;
    }

    public function running(): bool
    {
        return !$this->halted();
    }

    public function halted(): bool
    {
        return $this->halted;
    }

    public function opcode(): Opcode
    {
        return Factory::create($this);
    }

    public function toArray(): array
    {
        return $this->program;
    }

    public function output(): Output
    {
        return $this->output;
    }

    public function position(): int
    {
        return $this->position;
    }

    public function __toString()
    {
        return $this->toString();
    }

    private function toString(): string
    {
        return implode(',', $this->program);
    }

    /**
     * @return Input
     */
    public function input(): Input
    {
        return $this->input;
    }
}
