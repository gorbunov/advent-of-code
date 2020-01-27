<?php declare(strict_types=1);


namespace Repairing;


final class Position
{
    /**
     * @var int
     */
    private $x;
    /**
     * @var int
     */
    private $y;

    private function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public static function create(int $x, int $y): Position
    {
        return new self($x, $y);
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    public function move(int $direction): self
    {
        switch ($direction) {
            case Direction::NORTH:
                --$this->y;
                break;
            case Direction::SOUTH:
                ++$this->y;
                break;
            case Direction::EAST:
                ++$this->x;
                break;
            case Direction::WEST:
                --$this->x;
                break;
        }
        return $this;
    }

    public function __toString()
    {
        return sprintf('(%d,%d)', $this->x, $this->y);
    }
}
