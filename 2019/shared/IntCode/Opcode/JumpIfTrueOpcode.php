<?php declare(strict_types=1);


namespace IntCode\Opcode;

use IntCode\Program;

final class JumpIfTrueOpcode extends CommonOpcode
{
    public const OPCODE = 5;

    public function apply(): Program
    {
        [$param1, $param2] = $this->params();
        [$mode1, $mode2] = $this->modes();
        $operand1 = $this->program()->read($param1, $mode1);
        $operand2 = $this->program()->read($param2, $mode2);
        if ($operand1 === 0) { // false
            $this->program()->advance(self::size());
        } else {
            $this->program()->jumpTo($operand2);
        }
        return $this->program();
    }

    public static function size(): int
    {
        return 3;
    }
}
