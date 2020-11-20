<?php declare(strict_types=1);

final class Santa
{
    private Position2D $position;
    private string $name;

    private function __construct(Position2D $position, string $name = 'Santa')
    {
        $this->position = $position;
        $this->name = $name;
    }

    public static function create(int $x, int $y, string $name): self
    {
        return self::createAtPosition(Position2D::create($x, $y), $name);
    }

    public static function createAtPosition(Position2D $position, string $name): self
    {
        return new Santa(clone($position), $name);
    }

    public function moveDirection(string $direction): self
    {
        switch ($direction) {
            case Direction::NORTH:
                $this->moveNorth();
                break;
            case Direction::SOUTH:
                $this->moveSouth();
                break;
            case Direction::EAST:
                $this->moveEast();
                break;
            case Direction::WEST:
                $this->moveWest();
                break;
            default:
                throw new RuntimeException('Unknown direction');
        }
        return $this;
    }

    public function moveNorth(): self
    {
        $this->position->moveUp();
        return $this;
    }

    public function moveSouth(): self
    {
        $this->position->moveDown();
        return $this;
    }

    public function moveEast(): self
    {
        $this->position->moveRight();
        return $this;
    }

    public function moveWest(): self
    {
        $this->position->moveLeft();
        return $this;
    }

    /**
     * @immutable
     * @return Position2D
     */
    public function getPosition(): Position2D
    {
        return clone($this->position);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


}
