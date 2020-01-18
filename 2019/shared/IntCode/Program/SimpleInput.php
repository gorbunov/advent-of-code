<?php declare(strict_types=1);


namespace IntCode\Program;


final class SimpleInput implements Input
{
    /**
     * @var int[]
     */
    private $inputs;

    public function __construct(array $inputs)
    {
        $this->inputs = $inputs;
    }

    public function read(): ?int
    {
        return array_shift($this->inputs);
    }

    public function insert(int $value): Input
    {
        $this->inputs[] = $value;
        return $this;
    }
}
