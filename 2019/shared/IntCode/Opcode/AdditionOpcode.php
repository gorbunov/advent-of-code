<?php declare(strict_types=1);

namespace IntCode\Opcode;

use IntCode\Program;

final class AdditionOpcode extends CommonOpcode
{
    public const OPCODE = 1;

    public function apply(): Program
    {
        [$param1, $param2, $resultPosition] = $this->params();
        [$mode1, $mode2] = $this->modes();
        $operand1 = $this->program()->read($param1, $mode1);
        $operand2 = $this->program()->read($param2, $mode2);
        $this->program()->alter($resultPosition, $operand1 + $operand2, Mode::POSITION);
        return parent::apply();
    }

    public static function size(): int
    {
        return 4;
    }
}
