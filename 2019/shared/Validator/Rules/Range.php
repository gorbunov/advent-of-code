<?php declare(strict_types=1);


namespace Validator\Rules;


class Range implements Validation
{
    /**
     * @var int
     */
    private $start;
    /**
     * @var int
     */
    private $end;

    private function __construct(int $start, int $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public static function create(int $start, int $end): self
    {
        return new self($start, $end);
    }

    public function validate(int $value): bool
    {
        return $value > $this->start && $value < $this->end;
    }
}
