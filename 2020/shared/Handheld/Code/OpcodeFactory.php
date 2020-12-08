<?php declare(strict_types=1);


namespace Handheld\Code;


use RuntimeException;
use Handheld\Code\Opcodes\NoopOpcode;
use Handheld\Code\Opcodes\JumpOpcode;
use JetBrains\PhpStorm\ExpectedValues;
use Handheld\Code\Opcodes\AccumulatorOpcode;

use function array_key_exists;

final class OpcodeFactory
{
    private static array $knownOpcodes = [
        Opcode::OP_NOP => NoopOpcode::class,
        Opcode::OP_ACC => AccumulatorOpcode::class,
        Opcode::OP_JMP => JumpOpcode::class,
    ];


    public static function parse(string $line): Opcode
    {
        preg_match("~^(?'operator'\w+) (?'argument'[+-]?\d+)$~", $line, $matches);
        $operatorName = $matches['operator'];
        $argument = $matches['argument'];

        $opcodeClass = self::getOpcodeClass($operatorName);
        return new $opcodeClass($operatorName, $argument);
    }

    private static function getOpcodeClass(string $opcodeName): string
    {
        if (!array_key_exists($opcodeName, self::$knownOpcodes)) {
            throw new RuntimeException('Unknown opcode '.$opcodeName);
        }
        return self::$knownOpcodes[$opcodeName];
    }

    public static function alter(Opcode $opcode, string $type): Opcode
    {
        $class = self::getOpcodeClass($type);
        return new $class($type, $opcode->getArgument());
    }
}
