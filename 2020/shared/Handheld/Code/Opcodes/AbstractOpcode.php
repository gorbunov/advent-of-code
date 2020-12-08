<?php declare(strict_types=1);


namespace Handheld\Code\Opcodes;


use Handheld\Code\Opcode;

abstract class AbstractOpcode
{
    private string $name;
    private $argument;

    public function __construct(string $name, $argument)
    {
        $this->name = $name;
        $this->argument = $argument;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getArgument()
    {
        return $this->argument;
    }



}
