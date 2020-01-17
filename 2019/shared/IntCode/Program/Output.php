<?php declare(strict_types=1);


namespace IntCode\Program;


class Output
{
    private $outputs = [];

    private function __construct()
    {
    }

    public static function create(): self
    {
        return new self();
    }

    public function store(int $value): self
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
        return array_pop($this->outputs);
    }
}
