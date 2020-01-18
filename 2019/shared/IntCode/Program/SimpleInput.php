<?php declare(strict_types=1);


namespace IntCode\Program;


final class SimpleInput implements Input
{
    /**
     * @var int[]
     */
    private $inputs;

    private function __construct(array $inputs)
    {
        $this->inputs = $inputs;
    }

    public static function empty(): Input
    {
        return self::create([]);
    }

    public static function create(array $inputs): Input
    {
        return new self($inputs);
    }

    public function read(): ?int
    {
        return array_shift($this->inputs);
    }

    public function push(int $value): Input
    {
        $this->inputs[] = $value;
        return $this;
    }
}
