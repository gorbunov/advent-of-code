<?php declare(strict_types=1);


namespace Handheld\Code\Opcodes;


use Handheld\Code\Opcode;
use Handheld\Code\Program;

final class AccumulatorOpcode extends AbstractOpcode implements Opcode
{

    public function apply(Program $program)
    {
        $acc = $program->getMemory(Program::MEMORY_ACC);
        $acc += (int)$this->getArgument();
        $program->setMemory(Program::MEMORY_ACC, $acc);
        $program->nextPosition();
    }
}
