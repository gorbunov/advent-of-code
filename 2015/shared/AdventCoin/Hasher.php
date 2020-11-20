<?php declare(strict_types=1);


namespace AdventCoin;


final class Hasher
{
    private string $salt;

    public function __construct(string $salt)
    {
        $this->salt = $salt;
    }

    public static function create(string $salt): Hasher
    {
        return new self($salt);
    }

    public function hash(string $value): string
    {
        return $this->bhash($value);
    }

    public function bhash(string $value): string
    {
        return md5($this->getSaltedValue($value));
    }

    private function getSaltedValue(string $value): string
    {
        return $this->salt.$value;
    }
}
