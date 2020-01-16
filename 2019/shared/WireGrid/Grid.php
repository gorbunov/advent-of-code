<?php declare(strict_types=1);

namespace WireGrid;

final class Grid
{
    /**
     * @var Position
     */
    private $centralPort;

    /**
     * @var array<Wire>
     */
    private $wires;

    private function __construct(array $wires)
    {
        $this->centralPort = Position::create(0, 0);
        $this->wires = $wires;
    }

    public static function createFromWires(array $wires): self
    {
        $wires = array_map(
            static function (string $definition) {
                return Wire::createFromString($definition);
            },
            $wires
        );
        return new self($wires);
    }

    public function wires(): array
    {
        return $this->wires;
    }

    public function closest(): int
    {
        return min(...$this->distances());
    }

    public function distances(): array
    {
        $distances = [];
        foreach ($this->intersections() as $intersection) {
            $distances[] = $this->distanceFromCentralPort($intersection);
        }
        sort($distances, SORT_ASC);
        return $distances;
    }

    /**
     * @return Position[]
     */
    public function intersections(): array
    {
        /**
         * @var Wire $wire1
         * @var Wire $wire2
         */
        [$wire1, $wire2] = $this->wires;
        $intersections = $wire1->getIntersectionPoints($wire2);
        $intersections = array_unique($intersections, SORT_STRING);
        $intersections = array_filter(
            $intersections,
            static function (Position $position) {
                return !($position->x() === 0 && $position->y() === 0);
            },
        );
        return $intersections;
    }

    public function distanceFromCentralPort(Position $position): int
    {
        return $this->getCentralPort()->distance($position);
    }

    /**
     * @return Position
     */
    public function getCentralPort(): Position
    {
        return $this->centralPort;
    }

    public function fastest(): int
    {
        return min(...$this->distances_to_intersections());
    }

    public function distance_to_position(Position $position): int
    {
        /**
         * @var Wire $wire1
         * @var Wire $wire2
         */
        [$wire1, $wire2] = $this->wires;
        $wd1 = $wire1->stepsToPosition($position);
        $wd2 = $wire2->stepsToPosition($position);
        return $wd1 + $wd2;
    }

    public function distances_to_intersections(): array
    {
        $distances = [];
        foreach ($this->intersections() as $intersection) {
            $distances[] = $this->distance_to_position($intersection);
        }
        return $distances;
    }
}
