<?php declare(strict_types=1);


namespace AdventCoin;


final class Hasher
{
    private string $salt;
    private string $prefix_matcher;
    private int $prefix_size;

    public function __construct(string $salt, int $prefix_size)
    {
        $this->salt = $salt;
        $this->prefix_size = $prefix_size;
        $this->prefix_matcher = str_repeat('0', $this->prefix_size);
    }

    public static function create(string $salt, int $prefix_size): Hasher
    {
        return new self($salt, $prefix_size);
    }

    public function isCoinHash(string $value): bool
    {
        $hash = $this->hash($value);
        return strpos($hash, $this->prefix_matcher) === 0;
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
