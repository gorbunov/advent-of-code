<?php declare(strict_types=1);


namespace Gravity;

final class System
{
    private $time = 0;
    private $bodies = [];
    private $pairs;

    /**
     * System constructor.
     *
     * @param Body[] $bodies
     */
    private function __construct(array $bodies)
    {
        $pairs = [];
        foreach ($bodies as $body) {
            foreach ($this->bodies as $known) {
                $pairs[] = [$body, $known];
            }
            $this->bodies[] = $body;
        }
        $this->pairs = $pairs;
    }

    public static function load(array $lines): System
    {
        return self::create(self::parse($lines));
    }

    /**
     * @param array $positions
     *
     * @return System
     */
    public static function create(array $positions): System
    {
        $bodies = [];
        foreach ($positions as [$x, $y, $z]) {
            $bodies[] = Body::create($x, $y, $z);
        }

        return new self($bodies);
    }

    public static function parse(array $lines): array
    {
        $positions = [];
        foreach ($lines as $line) {
            $matches = [];
            preg_match('~^<x=([\d\-]+),\sy=([\d\-]+),\sz=([\d\-]+)>$~i', $line, $matches);
            unset($matches[0]);
            $positions[] = array_map('\intval', array_values($matches));
        }
        return $positions;
    }

    public function time(): int
    {
        return $this->time;
    }

    public function forward(): self
    {
        $this->time++;
        return $this;
    }

    public function __toString()
    {
        $display = '';
        foreach ($this->bodies as $i => $body) {
            $display .= sprintf("\nBody #%d: %s", $i, $body);
        }
        return $display;
    }
}
