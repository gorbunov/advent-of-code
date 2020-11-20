<?php declare(strict_types=1);


final class Position2D
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

    public function moveUp(): self
    {
        $this->y--;
        return $this;
    }

    public function moveDown(): self
    {
        $this->y++;
        return $this;
    }

    public function moveLeft(): self
    {
        $this->x--;
        return $this;
    }

    public function moveRight(): self
    {
        $this->x++;
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


}
