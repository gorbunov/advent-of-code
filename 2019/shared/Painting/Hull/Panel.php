<?php declare(strict_types=1);


namespace Painting\Hull;


class Panel
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
    private $color;
    /**
     * @var int
     */
    private $painted;

    private function __construct(int $x, int $y, $startColor)
    {
        $this->x = $x;
        $this->y = $y;
        $this->painted = 0;
        $this->color = $startColor;
    }

    public static function create(int $x, int $y, $startColor = 0): Panel
    {
        return new self($x, $y, $startColor);
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    /**
     * @return int
     */
    public function color(): int
    {
        return $this->color;
    }

    /**
     * @return int
     */
    public function painted(): int
    {
        return $this->painted;
    }

    public function paint(int $color): self
    {
        $this->color = $color;
        $this->painted++;
        return $this;
    }


}
