<?php declare(strict_types=1);


namespace IntCode\Opcode;


use IntCode\Program;

final class EqualsOpcode extends CommonOpcode
{
    public const OPCODE = 8;

    public static function size(): int
    {
        return 4;
    }

    public function apply(): Program
    {
        [$param1, $param2, $resultPosition] = $this->params();
        [$mode1, $mode2, $mode3] = $this->modes();
        $operand1 = $this->program()->read($param1, $mode1);
        $operand2 = $this->program()->read($param2, $mode2);
        $result = $operand1 === $operand2 ? 1 : 0;
        $this->program()->alter($resultPosition, $result, $mode3);
        return parent::apply();
    }
}
