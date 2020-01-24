<?php declare(strict_types=1);

namespace Asteroids;

final class Map
{
    /**
     * @var Position[]
     */
    private $asteroids;

    private function __construct(array $asteroids)
    {
        $this->asteroids = $asteroids;
    }

    /**
     * @param string[] $map
     *
     * @return Map
     */
    public static function load(array $map): Map
    {
        $asteroids = [];
        foreach ($map as $y => $line) {
            foreach (str_split($line) as $x => $element) {
                if ($element === '#') {
                    $asteroids[] = Position::create($x, $y);
                }
            }
        }
        return new self($asteroids);
    }

    public function asteroids(): array
    {
        return $this->asteroids;
    }

    public function isAnglesMatch(float $angle, float $other): bool
    {
        return (abs($angle - $other) < PHP_FLOAT_EPSILON);
    }

    /**
     * @return array
     */
    public function bestStationLocation(): array
    {
        $max = 0;
        $best = Position::create(0, 0);
        foreach ($this->asteroids as $asteroid) {
            $observed = $this->uniqueAnglesFrom($asteroid);
            if ($observed > $max) {
                $max = $observed;
                $best = $asteroid;
            }
        }
        return [$best, $max];
    }

    public function uniqueAnglesFrom(Position $position): int
    {
        return \count(array_unique($this->anglesToAsteroidsFrom($position)));
    }

    /**
     * @param Position $position
     *
     * @return float[]
     */
    public function anglesToAsteroidsFrom(Position $position): array
    {
        $angles = [];
        foreach ($this->asteroids as $asteroid) {
            if ($asteroid->same($position)) {
                continue;
            }
            $angles[] = $position->angle($asteroid);
        }
        return $angles;
    }
}
