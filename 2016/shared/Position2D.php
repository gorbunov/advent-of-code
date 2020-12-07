<?php declare(strict_types=1);


final class Position2D implements Stringable
{
    private int $x;
    private int $y;

    private function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public static function create(int $x, int $y): self
    {
        return new self($x, $y);
    }

    public function moveUp(int $distance = 1): self
    {
        $this->y += $distance;
        return $this;
    }

    public function moveDown(int $distance = 1): self
    {
        $this->y -= $distance;
        return $this;
    }

    public function moveLeft(int $distance = 1): self
    {
        $this->x -= $distance;
        return $this;
    }

    public function moveRight(int $distance = 1): self
    {
        $this->x += $distance;
        return $this;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    public function createWithOffset(int $xOffset, int $yOffset): Position2D
    {
        return Position2D::create($this->getX() + $xOffset, $this->getY() + $yOffset);
    }

    public function __toString()
    {
        return $this->getX().':'.$this->getY();
    }
}
