<?php declare(strict_types=1);


namespace Painting\Hull;


class Hull
{

    private $panels;
    private $minX = 0;
    private $minY = 0;
    private $maxX = 0;
    private $maxY = 0;

    private function __construct($startColor)
    {
        $this->panels[0][0] = Panel::create(0, 0, $startColor);
    }

    public static function create(int $startColor): Hull
    {
        return new self($startColor);
    }

    public function painted(): int
    {
        $painted = 0;
        foreach ($this->panels as $x => $row) {
            /** @var Panel $panel */
            foreach ($row as $y => $panel) {
                if ($panel->painted() > 0) {
                    $painted++;
                }
            }
        }
        return $painted;
    }

    public function size()
    {
        return sprintf("Size: %d×%d\n", $this->sizeX(), $this->sizeY());
    }

    public function sizeX(): int
    {
        return abs($this->minX) + abs($this->maxX);
    }

    private function sizeY(): int
    {
        return abs($this->minY) + abs($this->maxY);
    }

    public function image(): array
    {
        $image = [];
        for ($y = $this->minY; $y <= $this->maxY; $y++) {
            for ($x = $this->minX; $x <= $this->maxX; $x++) {
                $image[$y][$x] = $this->panel($x, $y)->color();
            }
        }
        $image = array_reverse($image); // was upside down
        return $image;
    }

    public function panel(int $x, int $y): Panel
    {
        if (!isset($this->panels[$x][$y])) {
            $this->panels[$x][$y] = Panel::create($x, $y);
            $this->minX = min($this->minX, $x);
            $this->minY = min($this->minY, $y);
            $this->maxY = max($this->maxY, $y);
            $this->maxX = max($this->maxX, $x);
        }
        return $this->panels[$x][$y];
    }
}
