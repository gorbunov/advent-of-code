<?php declare(strict_types=1);


namespace CityMap;


final class MapPosition
{
    public const LOOK_NORTH = 0;
    public const LOOK_EAST = 1;
    public const LOOK_SOUTH = 2;
    public const LOOK_WEST = 3;

    private array $rotation = [
        self::LOOK_NORTH,
        self::LOOK_EAST,
        self::LOOK_SOUTH,
        self::LOOK_WEST,
    ];

    #[ExpectedValues(valuesFromClass: MapPosition::class)]
    private int $orientation;
    private \Position2D $position;
    private array $visited = [];

    public function __construct()
    {
        $this->orientation = self::LOOK_NORTH;
        $this->position = \Position2D::create(0, 0);
        $this->storePosition($this->position);
    }

    private function storePosition(\Position2D $position)
    {
        $this->visited[] = clone $position;
    }

    public function getPosition(): \Position2D
    {
        return $this->position;
    }

    public function hadCrossing(): bool
    {
        $positions = array_map(
            function (\Position2D $position) {
                return $position->getX().':'.$position->getY();
            },
            $this->visited
        );
        return count($positions) !== array_unique($positions);
    }

    public function getFirstCrossing(): \Position2D
    {
        $positions = array_map(
            function (\Position2D $position) {
                return $position->getX().':'.$position->getY();
            },
            $this->visited
        );
        $tested = [];
        foreach ($positions as $position) {
            if (!\in_array($position, $tested, true)) {
                $tested[] = $position;
            } else {
                [$x, $y] = explode(':', $position);
                return \Position2D::create((int)$x, (int)$y);
            }
        }
    }

    public function turnLeft()
    {
        $nextIndex = $this->orientation + 1;
        if ($nextIndex >= count($this->rotation)) {
            $nextIndex = 0;
        }
        $this->orientation = $nextIndex;
    }

    public function turnRight()
    {
        $nextIndex = $this->orientation - 1;
        if ($nextIndex < 0) {
            $nextIndex = count($this->rotation) - 1;
        }
        $this->orientation = $nextIndex;
    }

    /**
     * @return int
     */
    public function getOrientation(): int
    {
        return $this->orientation;
    }

    public function moveForward(int $distance)
    {
        $previous = clone $this->position;
        switch ($this->orientation) {
            case self::LOOK_NORTH:
                $this->position->moveUp($distance);
                break;
            case self::LOOK_SOUTH:
                $this->position->moveDown($distance);
                break;
            case self::LOOK_EAST:
                $this->position->moveRight($distance);
                break;
            case self::LOOK_WEST:
                $this->position->moveLeft($distance);
                break;
            default:
                throw new \RuntimeException('Unexpected value');
        }
        $this->storeLine($previous, $this->position);
    }

    private function storeLine(\Position2D $from, \Position2D $to, int $distance)
    {
        foreach (range($from->getX(), $to->getX()) as $x) {
            foreach (range($from->getY(), $to->getY()) as $y) {
                $this->storePosition(\Position2D::create($x, $y));
            }
        }
    }

    public function getTaxicabDistance(): int
    {
        return $this->getTaxicabDistanceTo($this->position);
    }

    public function getTaxicabDistanceTo(\Position2D $position): int
    {
        return abs($position->getX()) + abs($position->getY());
    }


}
