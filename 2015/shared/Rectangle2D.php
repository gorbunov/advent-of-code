<?php declare(strict_types=1);


final class Rectangle2D
{
    private Position2D $corner1;
    private Position2D $corner2;

    public static function create(Position2D $corner1, Position2D $corner2)
    {
        return new self($corner1, $corner2);
    }

    private function __construct(Position2D $corner1, Position2D $corner2)
    {
        $this->corner1 = clone($corner1);
        $this->corner2 = clone($corner2);
    }

    public function each(callable $callback): self
    {
        for ($x = $this->corner1->getX(); $x <= $this->corner2->getX(); $x++) {
            for ($y = $this->corner1->getY(); $y <= $this->corner2->getY(); $y++) {
                $callback($x, $y);
            }
        }

        return $this;
    }
}
