<?php declare(strict_types=1);


namespace IntCode\Program;


class Input
{
    /**
     * @var int[]
     */
    private $inputs;

    private function __construct(array $inputs)
    {
        $this->inputs = $inputs;
    }

    public static function empty(): self
    {
        return self::create([]);
    }

    public static function create(array $inputs): self
    {
        return new self($inputs);
    }

    public function read(): ?int
    {
        return array_shift($this->inputs);
    }
}
