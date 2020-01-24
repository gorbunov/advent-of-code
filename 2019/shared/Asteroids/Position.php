<?php declare(strict_types=1);


namespace Asteroids;


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

    public function angle(Position $position): float
    {
        $angle = rad2deg(atan2($position->y - $this->y, $position->x - $this->x) + (M_PI / 2));
        return $angle < 0 ? 360 + $angle : $angle;
    }

    public function same(Position $position): bool
    {
        return ($this->x === $position->x() && $this->y === $position->y());
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    public function __toString()
    {
        return sprintf('(%d,%d)', $this->x, $this->y);
    }
}
