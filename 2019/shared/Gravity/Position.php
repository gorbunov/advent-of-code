<?php declare(strict_types=1);


namespace Gravity;


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
    /**
     * @var int
     */
    private $z;

    private function __construct(int $x, int $y, int $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    public static function create(int $x, int $y, int $z): Position
    {
        return new self($x, $y, $z);
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

    /**
     * @return int
     */
    public function z(): int
    {
        return $this->z;
    }

    public function modify(int $offsetX, int $offsetY, int $offsetZ): self
    {
        $this->x += $offsetX;
        $this->y += $offsetY;
        $this->z += $offsetZ;
        return $this;
    }

    public function __toString()
    {
        return sprintf('<x=%4d, y=%4d, z=%4d>', $this->x, $this->y, $this->z);
    }


}
