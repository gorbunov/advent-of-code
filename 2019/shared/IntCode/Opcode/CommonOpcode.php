<?php declare(strict_types=1);

namespace IntCode\Opcode;


use IntCode\Program;

abstract class CommonOpcode implements Opcode
{
    private $modes;
    /**
     * @var Program
     */
    private $program;
    /**
     * @var array
     */
    private $params;

    private function __construct(Program $program, array $modes, array $params)
    {
        $this->modes = $modes;
        $this->program = $program;
        $this->params = $params;
    }

    public static function create(Program $program, array $modes, array $params): Opcode
    {
        return new static($program, $modes, $params);
    }

    public function apply(): Program
    {
        return $this->program->advance(static::size());
    }

    public static function size(): int
    {
        return 4;
    }

    public function modes(): array
    {
        return $this->modes;
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function toString(): string
    {
        $modes = sprintf('[%s]', implode(', ', $this->modes));
        $params = sprintf('(%s)', implode(', ', $this->params));
        return sprintf('%s, size: %d; Mode: %s, Params: %s', \get_class($this), static::size(), $modes, $params);
    }

    public function params(): array
    {
        return $this->params;
    }

    public function program(): Program
    {
        return $this->program;
    }
}
