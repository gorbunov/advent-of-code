<?php declare(strict_types=1);


namespace AsmRunner;


final class Command
{
    private string $command;
    private array $operands;

    private function __construct(string $command, array $operands)
    {
        $this->command = $command;
        $this->operands = $operands;
    }

    public static function parse(string $command_line): Command
    {
        $command = trim(substr($command_line, 0, 3));
        $args = substr($command_line, 3);
        $args = explode(',', $args);
        $args = array_map('trim', $args);
        return new self($command, $args);
    }

    public function apply(CpuState $cpuState): CpuState
    {
        $result = CpuState::createNextFrom($cpuState);
        $op1 = $this->getOperands()[0];
        switch ($this->command) {
            case 'hlf':
                $result->setRegistry($op1, (int)ceil($cpuState->getRegistry($op1) / 2));
                break;
            case 'tpl':
                $result->setRegistry($op1, $cpuState->getRegistry($op1) * 3);
                break;
            case 'inc':
                $result->setRegistry($op1, $cpuState->getRegistry($op1) + 1);
                break;
            case 'jmp':
                $newPos = $cpuState->getPosition() + (int)$op1;
                $result->setPosition($newPos);
                break;
            case 'jie':
                $op2 = $this->getOperands()[1];
                if ($cpuState->getRegistry($op1) % 2 === 0) {
                    $newPos = $cpuState->getPosition() + (int)$op2;
                    $result->setPosition($newPos);
                }
                break;
            case 'jio':
                $op2 = $this->getOperands()[1];
                if ($cpuState->getRegistry($op1) === 1) {
                    $newPos = $cpuState->getPosition() + (int)$op2;
                    $result->setPosition($newPos);
                }
                break;
            default:
                throw new \RuntimeException('Unknown command');
        }
        return $result;
    }

    /**
     * @return array
     */
    public function getOperands(): array
    {
        return $this->operands;
    }

    /**
     * @return string
     */
    public function getCommand(): string
    {
        return $this->command;
    }
}
