<?php declare(strict_types=1);

namespace IntCode;

use IntCode\Opcode\Opcode;
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
     * Program constructor.
     *
     * @param array $program
     */
    private function __construct(array $program)
    {
        $this->program = $program;
    }

    public static function createFromArray(array $program)
    {
        $program = array_map('\intval', $program);
        return new self($program);
    }

    public function advance(int $size): self
    {
        $this->position += $size;
        return $this;
    }

    public function read(int $position): int
    {
        return $this->program[$position];
    }

    public function readAhead(int $count) : array
    {
        return \array_slice($this->program, $this->position, $count);
    }

    public function current(): int
    {
        return $this->program[$this->position];
    }

    public function alter(int $position, int $value): self
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

    public function __toString()
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return implode(',', $this->program);
    }
}
