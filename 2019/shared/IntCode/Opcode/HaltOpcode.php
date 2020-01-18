<?php declare(strict_types=1);


namespace IntCode\Opcode;


use IntCode\Program;

final class HaltOpcode extends CommonOpcode
{
    public const OPCODE = 99;
    public static $COLOR = 'red';

    public function apply(): Program
    {
        $this->program()->halt();
        return parent::apply();
    }

    public static function size(): int
    {
        return 1;
    }
}
