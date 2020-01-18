<?php declare(strict_types=1);


namespace IntCode\Program;


final class SimpleOutput implements Output
{
    private $outputs = [];

    public function __construct()
    {
    }

    public function store(int $value): Output
    {
        $this->outputs[] = $value;
        return $this;
    }

    public function outputs(): array
    {
        return $this->outputs;
    }

    public function pop(): ?int
    {
        return array_shift($this->outputs);
    }
}
