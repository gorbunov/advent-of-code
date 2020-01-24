<?php declare(strict_types=1);


namespace Gravity;

final class System
{
    private $time = 0;
    /** @var Body */
    private $bodies = [];
    private $pairs;

    private $startEnergy;
    /** @var Body[] */
    private $initialState;

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
            $this->initialState[] = Body::fromBody($body);
        }
        $this->pairs = $pairs;
        $this->startEnergy = $this->energy();
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
        $display .= sprintf("\n Total energy: %5d\n", $this->energy());
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

    public function stablize()
    {
        do {
            $this->forward();
        } while (!$this->matchedInitialState());
        return $this;
    }

    public function matchedInitialState(): bool
    {
        if ($this->startEnergy !== $this->energy()) {
            return false;
        }
        /**
         * @var int  $key
         * @var Body $body
         */
        foreach ($this->bodies as $key => $body) {
            if (!$body->equals($this->initialState[$key])) {
                return false;
            }
        }

        return true;
    }

    public function matchedOnAxis(int $axis): bool
    {
        /**
         * @var Body $body
         */
        foreach ($this->bodies as $key => $body) {
            if (!$body->axisEqual($this->initialState[$key], $axis)) {
                return false;
            }
        }
        return true;
    }

    public function matchedOnAnyAxis(): bool
    {
        foreach (range(0, 2) as $axis) {
            if ($this->matchedOnAxis($axis)) {
                return true;
            }
        }
        return false;
    }

    private function axisPeriods(): array
    {
        $matched = [];
        do {
            $this->forward();
            if ($this->matchedOnAnyAxis()) {
                foreach (range(0,2) as $axis) {
                    if ($this->matchedOnAxis($axis)) {
                        if (!isset($matched[$axis])) {
                            $matched[$axis] = $this->time();
                        }
                    }
                }
            }
        } while (count($matched) < 3);

        return $matched;
    }

    public function cycleSize(): int
    {
        return lcm($this->axisPeriods());
    }
}
