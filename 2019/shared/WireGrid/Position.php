<?php declare(strict_types=1);

namespace WireGrid;

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

    public static function create(int $x, int $y): self
    {
        return new self($x, $y);
    }

    public function distance(Position $position): int
    {
        return abs($this->x() - $position->x()) + abs($this->y - $position->y());
    }

    /**
     * @return int
     */
    public function x(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function y(): int
    {
        return $this->y;
    }

    public function apply(Direction $direction): Position
    {
        return $direction->fromPosition($this);
    }

    public function equals(Position $position): bool
    {
        return $this->x() === $position->x() && $this->y() === $position->y();
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return sprintf('(%d, %d)', $this->x, $this->y);
    }
}
