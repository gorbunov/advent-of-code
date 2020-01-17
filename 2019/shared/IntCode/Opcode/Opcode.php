<?php declare(strict_types=1);

namespace IntCode\Opcode;

use IntCode\Program;

interface Opcode
{
    public static function size(): int;

    public static function create(Program $program, array $params, array $modes): Opcode;

    public function apply(): Program;

    public function program(): Program;

    public function modes(): array;

    public function params(): array;
}
