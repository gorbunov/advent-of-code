<?php declare(strict_types=1);

namespace Validator\Rules;

final class DigitsCount implements Validation
{
    /**
     * @var int
     */
    private $count;

    public static function create(int $count): self
    {
        return new self($count);
    }

    private function __construct(int $count)
    {
        $this->count = $count;
    }

    public function validate(int $value): bool
    {
        return strlen((string)$value) === $this->count;
    }
}
