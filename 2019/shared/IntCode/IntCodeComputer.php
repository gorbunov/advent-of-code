<?php declare(strict_types=1);

namespace IntCode;

use Closure;
use IntCode\Program\Input;

class IntCodeComputer
{
    /**
     * @var Program
     */
    private $memory;

    private function __construct(string $memory)
    {
        $this->memory = $memory;
    }

    public static function load(string $memory): self
    {
        return new self($memory);
    }

    private function reboot(): Program
    {
        $opcodes = explode(',', $this->memory);
        return Program::createFromArray($opcodes);
    }

    public function run(?Closure $bootloader = null): Program
    {
        return $this->boot($bootloader)->run()->program();
    }

    private function boot(?Closure $bootloader): IntCodeRunner
    {
        $program = $this->reboot();
        if ($bootloader) {
            $program = $bootloader($program);
        }
        return IntCodeRunner::fromProgram($program);
    }

}
