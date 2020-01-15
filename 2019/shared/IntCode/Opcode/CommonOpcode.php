<?php declare(strict_types=1);

namespace IntCode\Opcode;


use IntCode\Program;

abstract class CommonOpcode implements Opcode
{
    public function apply(Program $program): Program
    {
        $program->advance($this->size());
        return $program;
    }

    protected function params(Program $program): array
    {
        return \array_slice($program->readAhead($this->size()), 1); // offset 1 - opcode itself
    }

    private function size(): int
    {
        return 4;
    }

}
