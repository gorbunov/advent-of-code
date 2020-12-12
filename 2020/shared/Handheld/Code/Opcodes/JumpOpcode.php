<?php declare(strict_types=1);


namespace Handheld\Code\Opcodes;


use Handheld\Code\Opcode;
use Handheld\Code\Program;

final class JumpOpcode extends AbstractOpcode implements Opcode
{

    public function apply(Program $program)
    {
        $pos = $program->getPosition();
        $pos += (int)$this->getArgument();
        $program->setPosition($pos);
    }
}
