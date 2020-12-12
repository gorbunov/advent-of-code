<?php declare(strict_types=1);


namespace Handheld;


use Handheld\Code\Program;

final class Console
{
    /**
     * @var Program
     */
    private Program $program;

    public function __construct()
    {
    }

    public function getAcc(): int
    {
        return $this->getVar(Program::MEMORY_ACC);
    }

    public function getVar(string $name)
    {
        return $this->program->getMemory($name);
    }

    public function runUntilNotHalted(Program $program)
    {
        foreach ($program->getJmpOrNopInstructionsPositions() as $fix_position) {
            $fixed_program = $program->copy();
            $fixed_program->swapJmpNopOpcodeAtPosition($fix_position);
            $this->run($fixed_program);
            if (!$fixed_program->wasHalted()) {
                break;
            }
        }
    }

    public function run(Program $program)
    {
        $this->program = $program;
        $this->program->reset();
        $this->program->run();
    }

}
