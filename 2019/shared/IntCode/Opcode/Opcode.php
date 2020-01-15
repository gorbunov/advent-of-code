<?php declare(strict_types=1);

namespace IntCode\Opcode;

use IntCode\Program;

interface Opcode
{
    public function apply(Program $program): Program;
}
