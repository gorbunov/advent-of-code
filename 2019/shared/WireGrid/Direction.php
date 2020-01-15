<?php declare(strict_types=1);

namespace WireGrid;

final class Direction
{
    public const UP = 'U';
    public const DOWN = 'D';
    public const LEFT = 'L';
    public const RIGHT = 'R';
    /**
     * @var string
     */
    private $direction;
    /**
     * @var int
     */
    private $distance;

    /**
     * Direction constructor.
     *
     * @param string $direction
     * @param int    $distance
     */
    private function __construct(string $direction, int $distance)
    {
        $this->direction = $direction;
        $this->distance = $distance;
    }

    public static function fromString(string $definition): Direction
    {
        [$direction, $distance] = [$definition[0], substr($definition, 1)];
        return new self($direction, (int)$distance);
    }

    public function fromPosition(Position $position): Position
    {
        $offsetX = $offsetY = 0;
        switch ($this->direction) {
            case self::UP:
                $offsetY = $this->distance;
                break;
            case self::DOWN:
                $offsetY = $this->distance * -1;
                break;
            case self::LEFT:
                $offsetX = $this->distance * -1;
                break;
            case self::RIGHT:
                $offsetX = $this->distance;
                break;
        }

        return Position::create($position->x() + $offsetX, $position->y() + $offsetY);
    }
}
