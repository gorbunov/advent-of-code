<?php declare(strict_types=1);


namespace IntCode\Program;


final class IOPass implements Output, Input
{
    /**
     * @var int[]
     */
    private $queue = [];

    public static function create(): IOPass
    {
        return new self();
    }

    public function store(int $value): Output
    {
        return $this->queue($value);
    }

    private function queue(int $value): self
    {
        $this->queue[] = $value;
        return $this;
    }

    public function insert(int $value): Input
    {
        return $this->queue($value);
    }

    public function outputs(): array
    {
        return $this->queue;
    }

    public function pop(): ?int
    {
        return $this->read();
    }

    public function read(): ?int
    {
        return array_shift($this->queue);
    }
}
