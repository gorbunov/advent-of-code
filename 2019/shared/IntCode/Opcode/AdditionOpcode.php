<?php declare(strict_types=1);

namespace IntCode\Opcode;

use IntCode\Program;

final class AdditionOpcode extends CommonOpcode
{
    public function apply(Program $program): Program
    {
        [$op1Position, $op2Position, $resultPosition] = $this->params($program);
        $operand1 = $program->read($op1Position);
        $operand2 = $program->read($op2Position);
        $program->alter($resultPosition, $operand1 + $operand2);
        return parent::apply($program);
    }
}
