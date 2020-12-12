<?php declare(strict_types=1);


namespace Handheld\Code;


final class Program
{
    public const MEMORY_ACC = 'accumulator';
    private int $position;
    /** @var Opcode[] */
    private array $instructions;
    private array $memory;
    private array $visitedInstructions = [];
    private bool $halt = false;

    public function __construct(array $instructions)
    {
        $this->instructions = $instructions;
        $this->memory = [];
        $this->reset();
    }

    public function reset()
    {
        $this->memory[self::MEMORY_ACC] = 0;
        $this->visitedInstructions = [];
        $this->halt = false;
        $this->position = 0;
    }

    public static function load(array $instructions): Program
    {
        $commands = [];
        foreach ($instructions as $instruction) {
            $commands[] = OpcodeFactory::parse($instruction);
        }
        return new self($commands);
    }

    public function copy(): Program
    {
        $cloned_instructions = [];
        foreach ($this->instructions as $instruction) {
            $cloned_instructions[] = clone $instruction;
        }
        return new Program($cloned_instructions);
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function nextPosition()
    {
        $this->position++;
    }

    public function getMemory(string $name)
    {
        return $this->memory[$name];
    }

    public function setMemory(string $name, $value)
    {
        $this->memory[$name] = $value;
    }

    public function run()
    {
        while (\array_key_exists($this->position, $this->instructions) && !$this->halt) {
            $this->stepOnce();
        }
    }

    public function stepOnce(): void
    {
        if (\in_array($this->position, $this->visitedInstructions, true)) { // loop
            $this->halt = true;
            return;
        }
        $opcode = $this->instructions[$this->position];
        $this->visitedInstructions[] = $this->position;
        // printf("%d, %s(%s) (#%s)\n", $this->position, $opcode->getName(), $opcode->getArgument(), spl_object_id($opcode));
        $opcode->apply($this);
    }

    public function wasHalted(): bool
    {
        return $this->halt;
    }

    public function getJmpOrNopInstructionsPositions(): array
    {
        return array_keys(array_filter($this->instructions, fn(Opcode $opcode) => \in_array($opcode->getName(), [Opcode::OP_JMP, Opcode::OP_NOP], true)));
    }

    public function swapJmpNopOpcodeAtPosition(int $position)
    {
        $current = $this->instructions[$position];
        $this->instructions[$position] = self::swapJmpNopOpcode($current);
    }

    private static function swapJmpNopOpcode(Opcode $opcode): Opcode
    {
        $swaps = [
            Opcode::OP_NOP => Opcode::OP_JMP,
            Opcode::OP_JMP => Opcode::OP_NOP,
        ];
        return OpcodeFactory::alter($opcode, $swaps[$opcode->getName()]);
    }
}
