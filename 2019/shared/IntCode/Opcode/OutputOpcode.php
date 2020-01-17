<?php declare(strict_types=1);

namespace IntCode\Opcode;

use IntCode\Program;

final class OutputOpcode extends CommonOpcode
{
    public function apply(): Program
    {
        return parent::apply();
    }

    public static function size(): int
    {
        return 2;
    }
}
