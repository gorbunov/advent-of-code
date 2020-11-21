<?php declare(strict_types=1);


namespace Guests;


final class Relation
{
    private string $to;
    private int $amount;

    public function __construct(string $to, int $amount)
    {
        $this->to = $to;
        $this->amount = $amount;
    }

    public static function create(string $to, int $amount): Relation
    {
        return new self($to, $amount);
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }
}
