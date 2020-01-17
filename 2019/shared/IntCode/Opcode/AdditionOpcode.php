<?php declare(strict_types=1);

namespace IntCode\Opcode;

use IntCode\Program;

final class AdditionOpcode extends CommonOpcode
{
    public function apply(): Program
    {
        [$param1, $param2, $resultPosition] = $this->params();
        $operand1 = $this->program()->read($param1);
        $operand2 = $this->program()->read($param2);
        $this->program()->alter($resultPosition, $operand1 + $operand2);
        return parent::apply();
    }

    public static function size(): int
    {
        return 4;
    }
}
