<?php declare(strict_types=1);

namespace IntCode\Opcode;


use IntCode\Program;

abstract class CommonOpcode implements Opcode
{
    private $modes;
    public static function create(array $modes): Opcode
    {
        return new static($modes);
    }

    private function __construct(array $modes)
    {
        $this->modes = $modes;
    }

    public function apply(Program $program): Program
    {
        $program->advance(self::size());
        return $program;
    }

    protected function params(Program $program): array
    {
        return \array_slice($program->readAhead(self::size()), 1); // offset 1 - opcode itself
    }

    public static function size(): int
    {
        return 4;
    }

    public function modes(): array
    {
        return $this->modes;
    }

}
