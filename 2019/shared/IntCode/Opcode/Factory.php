<?php declare(strict_types=1);


namespace IntCode\Opcode;


use IntCode\Program;

class Factory
{
    private static $mapping = [
        1  => AdditionOpcode::class,
        2  => MultiplicationOpcode::class,
        99 => HaltOpcode::class,
    ];

    public static function create(Program $program): Opcode
    {
        return new self::$mapping[$program->current()]();
    }
}
