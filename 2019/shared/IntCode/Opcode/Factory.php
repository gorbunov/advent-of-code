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
        $class = self::$mapping[$opcode] ?? null;
        if (!$class) {
            throw new \RuntimeException(sprintf("Unknown OpCode: %d\n Position: %d, Program: %s\n", $opcode, $program->position(), $program));
        }
        $params = self::readParams($program, $class::size());
        return $class::create($program, $modes, $params);
    }

    private static function parseOpcodeMode(int $opcode): array
    {
        $strOpcode = str_split(str_pad((string)$opcode, 5, '0', STR_PAD_LEFT), 1);
        $opBytes = array_splice($strOpcode, -2);
        $opcode = (int)implode($opBytes);
        $modes = array_map('\intval', $strOpcode);
        return [$opcode, $modes];
    }

    private static function readParams(Program $program, int $size): array
    {
        return \array_slice($program->readAhead($size), 1); // offset 1 - opcode itself
    }
}
