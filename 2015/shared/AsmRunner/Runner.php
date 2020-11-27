<?php declare(strict_types=1);


namespace AsmRunner;


final class Runner
{
    private CpuState $cpuState;

    public function __construct()
    {
        $this->reset();
    }

    private function reset()
    {
        $this->cpuState = CpuState::create();
    }

    public static function create()
    {
        return new self();
    }

    public function run(Program $program): CpuState
    {
        while (!$this->programEnded($program)) {
            $this->stepOnce($program);
        }
        return $this->cpuState;
    }

    private function programEnded(Program $program): bool
    {
        return !$program->hasCommandAt($this->cpuState->getPosition());
    }

    public function stepOnce(Program $program)
    {
        if (!$this->programEnded($program)) {
            $command = $program->getCommandAt($this->cpuState->getPosition());
            printf("Step: %s\n", $command->getCommand());
            $this->cpuState = $command->apply($this->cpuState);
        }
    }
}
