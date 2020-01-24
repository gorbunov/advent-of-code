<?php declare(strict_types=1);

namespace Chemistry;

final class Storage
{
    private $stored = [];

    private function __construct()
    {
    }

    public static function create()
    {
        return new self();
    }

    public function store(string $element, int $amount): self
    {
        if (!isset($this->stored[$element])) {
            $this->stored[$element] = 0;
        }
        $this->stored[$element] += $amount;
        return $this;
    }

    public function consume(string $element, int $amount): int
    {
        $this->store($element, -1 * $amount);
        return $this->stored[$element];
    }

    public function __toString()
    {
        $display = '';
        foreach ($this->stored as $element => $amount) {
            $display.= sprintf("%s: %6d\n", $element, $amount);
        }
        return $display;
    }

    public function get(string $element):int
    {
        return $this->stored[$element]??0;
    }
}
