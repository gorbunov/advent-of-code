<?php declare(strict_types=1);


namespace IntCode\Opcode;


final class LessThanOpcode extends CommonOpcode
{
    public const OPCODE = 7;

    public static function size(): int
    {
        return 4;
    }
}
