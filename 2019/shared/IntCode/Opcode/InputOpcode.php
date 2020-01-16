<?php declare(strict_types=1);

namespace IntCode\Opcode;

use IntCode\Program;

final class InputOpcode extends CommonOpcode
{

    public function apply(Program $program): Program
    {
        return parent::apply($program);
    }

    public static function size(): int
    {
        return 2;
    }

}
