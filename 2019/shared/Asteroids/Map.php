<?php declare(strict_types=1);

namespace Asteroids;

final class Map
{
    public const DEBUG = true;
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

    public function vaporize(Position $position): array
    {
        $vaporization = [];
        $iteration = 0;
        $asteroids = $this->angleSortedAsteroids($position);
        while (!empty($asteroids)) {
            $laserAt = -1;
            foreach ($asteroids as $asteroidId => &$angle) {
                if ($angle === $laserAt) {
                    continue;
                }

                $laserAt = $angle;
                if (self::DEBUG) {
                    printf("Destroying %d, at angle %0.4f, position: %s\n", $iteration++, $angle, $this->asteroids[$asteroidId]);
                }
                $vaporization[$iteration] = $this->asteroids[$asteroidId];
                unset($asteroids[$asteroidId]);
            }
        }
        return $vaporization;
    }

    public function angleSortedAsteroids(Position $position): array
    {
        $angles = $this->anglesToAsteroidsFrom($position);
        asort($angles, SORT_DESC | SORT_NUMERIC);
        return $angles;
    }
}
