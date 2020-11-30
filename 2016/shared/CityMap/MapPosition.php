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

    public function __construct()
    {
        $this->orientation = self::LOOK_NORTH;
        $this->position = \Position2D::create(0, 0);
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

    public function getPosition(): \Position2D
    {
        return $this->position;
    }

    public function moveForward(int $distance)
    {
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
    }

    public function getTaxicabDistance(): int
    {
        return abs($this->position->getX()) + abs($this->position->getY());
    }


}
