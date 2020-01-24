<?php declare(strict_types=1);

namespace IntCode;

use IntCode\Program\Input;
use IntCode\Opcode\Opcode;
use IntCode\Program\Output;
use IntCode\Opcode\HaltOpcode;
use IntCode\Opcode\OutputOpcode;

class IntCodeRunner
{
    private const DEBUG = true;
    /**
     * @var Program
     */
    private $program;
    /**
     * @var Program
     */
    private $source;

    /**
     * IntCode constructor.
     *
     * @param Program $program
     */
    private function __construct(Program $program)
    {
        $this->source = $program;
        $this->program = $program;
    }

    public static function fromCodeString(string $code, Input $input, Output $output = null): self
    {
        $opcodes = explode(',', $code);
        $program = Program::createFromArray($opcodes, $input, $output);
        return self::fromProgram($program);
    }

    public static function fromProgram(Program $program): self
    {
        return new self($program);
    }

    public function run(): self
    {
        $this->reset();
        $step = 0;
        while ($this->program->running()) {
            if (self::DEBUG) {
                printf('Step: %d, Position: %d; ', $step++, $this->program()->position());
            }
            $opcode = $this->program->opcode();
            $this->apply($opcode);
        }
        return $this;
    }

    public function reset(): self
    {
        $this->program = clone $this->source;
        return $this;
    }

    /**
     * @return Program
     */
    public function program(): Program
    {
        return $this->program;
    }

    private function apply(Opcode $opcode): self
    {
        if (self::DEBUG) {
            printf("Opcode: %s\n", $opcode);
            $prgAarr = $this->program->toArray();
            $stPos = max(0, $this->program()->position() - 5);
            $beforeOpcode = \array_slice($prgAarr, $stPos, min(5, $this->program->position() - $stPos));
            $size = \call_user_func([\get_class($opcode), 'size']);
            $atOpcode = \array_slice($prgAarr, $this->program()->position(), $size);
            $afterOpcode = \array_slice($prgAarr, $this->program->position() + $size, 5);
            $opcodeColor = $opcode::$COLOR;
            printf("Program: %s >> %s << %s\n", implode(',', $beforeOpcode), implode(',', color_array($atOpcode, $opcodeColor)), implode(',', $afterOpcode));
        }
        $this->program = $opcode->apply();
        return $this;
    }

    /**
     * @return bool is_halted - true, if halted
     * @noinspection MultipleReturnStatementsInspection
     */
    public function untilOutput(): bool
    {
        while ($this->program->running()) {
            $opcode = $this->program->opcode();
            $this->apply($opcode);
            if (self::DEBUG) {
                printf('Position: %d; ', $this->program()->position());
            }
            if ($opcode instanceof OutputOpcode) {
                return false;
            }
            if ($opcode instanceof HaltOpcode) {
                return true;
            }
        }
        return true;
    }

    public function halted(): bool
    {
        return $this->program->halted();
    }
}
