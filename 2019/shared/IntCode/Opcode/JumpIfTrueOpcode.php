<?php declare(strict_types=1);


namespace IntCode\Opcode;

final class JumpIfTrueOpcode extends CommonOpcode
{
    public const OPCODE = 5;

    public static function size(): int
    {
        return 3;
    }
}
