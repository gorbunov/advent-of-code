<?php declare(strict_types=1);


namespace IntCode\Opcode;

final class JumpIfFalseOpcode extends CommonOpcode
{
    public const OPCODE = 6;

    public static function size(): int
    {
        return 3;
    }
}
