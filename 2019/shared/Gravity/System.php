<?php declare(strict_types=1);


namespace Gravity;

final class System
{
    private $time = 0;
    /** @var Body */
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

    public function __toString()
    {
        $display = '';
        foreach ($this->bodies as $i => $body) {
            $display .= sprintf("\nBody #%d: %s", $i, $body);
        }
        $display.= sprintf("\n Total energy: %5d\n", $this->energy());
        return $display;
    }

    public function simulate(int $steps): self
    {
        for ($i = 0; $i < $steps; $i++) {
            $this->forward();
        }
        return $this;
    }

    public function forward(): self
    {
        $this->time++;
        /**
         * @var Body $body1
         * @var Body $body2
         */
        foreach ($this->pairs as [$body1, $body2]) {
            $body1->applyBodyGravity($body2);
            $body2->applyBodyGravity($body1);
        }
        /** @var Body $body */
        foreach ($this->bodies as $body) {
            $body->applyVelocity();
        }
        return $this;
    }

    public function energy(): int
    {
        $energy = 0;
        /** @var Body $body */
        foreach ($this->bodies as $body) {
            $energy += $body->energy();
        }
        return $energy;
    }
}
