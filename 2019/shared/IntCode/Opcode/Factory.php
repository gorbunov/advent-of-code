<?php declare(strict_types=1);


namespace IntCode\Opcode;


use IntCode\Program;

class Factory
{
    private static $mapping = [
        1  => AdditionOpcode::class,
        2  => MultiplicationOpcode::class,
        3  => InputOpcode::class,
        4  => OutputOpcode::class,
        99 => HaltOpcode::class,
    ];

    public static function create(Program $program): Opcode
    {
        $opcode = $program->current();
        [$opcode, $modes] = self::parseOpcodeMode($opcode);
        /** @var Opcode $class */
        $class = self::$mapping[$opcode];
        return $class::create($modes);
    }

    private static function parseOpcodeMode(int $opcode): array
    {
        $strOpcode = str_split(str_pad((string)$opcode, 5, '0', STR_PAD_LEFT), 1);
        $opBytes = array_splice($strOpcode, -2);
        $opcode = (int)implode($opBytes);
        $modes = array_map('\intval', $strOpcode);
        return [$opcode, $modes];
    }
}