<?php declare(strict_types=1);


namespace IntCode;


class IntCodeComputer
{
    /**
     * @var Program
     */
    private $memory;

    private function __construct(Program $program)
    {
        $this->memory = $program;
    }

    public static function load(string $memory): self
    {
        $opcodes = explode(',', $memory);
        $program = Program::createFromArray($opcodes);
        return new self($program);
    }

    public function run(Bootloader $bootloader): Program
    {
        return $this->boot($bootloader)->run()->program();
    }

    private function boot(Bootloader $bootloader): IntCodeRunner
    {
        $program = $bootloader($this->memory);
        return IntCodeRunner::fromProgram($program);
    }

}
