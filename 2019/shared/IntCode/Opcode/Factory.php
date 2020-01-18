<?php declare(strict_types=1);


namespace IntCode\Opcode;


use IntCode\Program;

use RuntimeException;

use function array_slice;

class Factory
{
    private static $mapping = [
        AdditionOpcode::OPCODE       => AdditionOpcode::class,
        MultiplicationOpcode::OPCODE => MultiplicationOpcode::class,
        InputOpcode::OPCODE          => InputOpcode::class,
        OutputOpcode::OPCODE         => OutputOpcode::class,
        JumpIfTrueOpcode::OPCODE     => JumpIfTrueOpcode::class,
        JumpIfFalseOpcode::OPCODE    => JumpIfFalseOpcode::class,
        LessThanOpcode::OPCODE       => LessThanOpcode::class,
        EqualsOpcode::OPCODE         => EqualsOpcode::class,
        HaltOpcode::OPCODE           => HaltOpcode::class,
    ];

    public static function create(Program $program): Opcode
    {
        $raw_opcode = $program->current();
        [$opcode, $modes] = self::parseOpcodeMode($raw_opcode);
        /** @var Opcode $class */
        $class = self::$mapping[$opcode] ?? null;
        if (!$class) {
            throw new RuntimeException(sprintf("Unknown OpCode: %d (%d)\n Position: %d, Program: %s\n", $opcode, $raw_opcode, $program->position(), $program));
        }
        $params = self::readParams($program, $class::size());
        return $class::create($program, $modes, $params);
    }

    private static function parseOpcodeMode(int $opcode): array
    {
        $strOpcode = str_split(str_pad((string)$opcode, 5, '0', STR_PAD_LEFT), 1);
        $opBytes = array_splice($strOpcode, -2);
        $opcode = (int)implode($opBytes);
        $modes = array_map('\intval', array_reverse($strOpcode));
        return [$opcode, $modes];
    }

    private static function readParams(Program $program, int $size): array
    {
        return array_slice($program->readAhead($size), 1); // offset 1 - opcode itself
    }
}
