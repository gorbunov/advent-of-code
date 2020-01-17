<?php declare(strict_types=1);


namespace IntCode\Opcode;


use IntCode\Program;

final class MultiplicationOpcode extends CommonOpcode
{
    public function apply(): Program
    {
        [$op1Position, $op2Position, $resultPosition] = $this->params();
        $operand1 = $this->program()->read($op1Position);
        $operand2 = $this->program()->read($op2Position);
        $this->program()->alter($resultPosition, $operand1 * $operand2);
        return parent::apply();
    }
}
