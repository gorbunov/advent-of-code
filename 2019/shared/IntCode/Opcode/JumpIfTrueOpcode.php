<?php declare(strict_types=1);


namespace IntCode\Opcode;

use IntCode\Program;

final class JumpIfTrueOpcode extends CommonOpcode
{
    public const OPCODE = 5;

    public static function size(): int
    {
        return 3;
    }

    public function apply(): Program
    {

    }
}
