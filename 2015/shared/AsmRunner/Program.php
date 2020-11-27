<?php declare(strict_types=1);


namespace AsmRunner;


final class Program
{
    private array $commands = [];
    private int $position;

    private function __construct()
    {
        $this->position = 0;
    }

    public static function parse(array $commandlist): Program
    {
        $program = new self();
        foreach ($commandlist as $line) {
            $program->addCommand(Command::parse($line));
        }
        return $program;
    }

    public function addCommand(Command $command): void
    {
        $this->commands[] = $command;
    }

    public function hasCommandAt(int $index): bool
    {
        return isset($this->commands[$index]);
    }

    public function getCommandAt(int $index): Command
    {
        return $this->commands[$index];
    }
}
