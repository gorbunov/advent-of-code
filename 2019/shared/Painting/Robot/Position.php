<?php declare(strict_types=1);


namespace Painting\Robot;


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
        $this->orientation = Orientation::create();
        $this->x = $x;
        $this->y = $y;
    }

    public static function create(int $x, int $y): Position
    {
        return new self($x, $y);
    }

    public function forward(): self
    {
        switch ($this->orientation()) {
            case Orientation::UP:
                ++$this->y;
                break;
            case Orientation::DOWN:
                --$this->y;
                break;
            case Orientation::LEFT:
                --$this->x;
                break;
            case Orientation::RIGHT:
                ++$this->x;
        }
        return $this;
    }

    public function orientation(): string
    {
        return $this->orientation->orientation();
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

    public function turn(string $turnDirection): self
    {
        $this->orientation->turn($turnDirection);
        return $this;
    }

    public function __toString()
    {
        return sprintf('(%d,%d)', $this->x, $this->y);
    }


}
