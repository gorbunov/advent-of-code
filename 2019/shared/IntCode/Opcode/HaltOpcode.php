<?php declare(strict_types=1);


namespace IntCode\Opcode;


use IntCode\Program;

final class HaltOpcode extends CommonOpcode
{
    public function apply(Program $program): Program
    {
        $program = $program->halt();
        return parent::apply($program);
    }
}
