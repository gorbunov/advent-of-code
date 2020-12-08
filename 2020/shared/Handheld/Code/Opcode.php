<?php declare(strict_types=1);


namespace Handheld\Code;


interface Opcode
{
    public const OP_NOP = 'nop';
    public const OP_JMP = 'jmp';
    public const OP_ACC = 'acc';

    public function getArgument();

    public function getName();

    public function apply(Program $program);
}
