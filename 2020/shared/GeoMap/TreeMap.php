<?php declare(strict_types=1);


namespace GeoMap;


final class TreeMap
{
    public const TREE = '#';
    public const EMPTY = '.';

    /** @var array[] */
    private array $map = [];
    private int $sizeX = 0;
    private int $sizeY = 0;

    private function __construct(array $map)
    {
        $this->map = $map;
        $this->sizeY = \count($map);
        $this->sizeX = \count($map[0]);
    }

    public static function load(array $mapRows): TreeMap
    {
        $map = array_map('\str_split', $mapRows);
        return new self($map);
    }

    public function __toString()
    {
        $map = '';
        foreach ($this->map as $row) {
            $map .= implode($row)."\n";
        }
        return $map;
    }

    /**
     * @return int
     */
    public function getSizeX(): int
    {
        return $this->sizeX;
    }

    public function checkSlope(int $changeX, int $changeY): int
    {
        $position = \Position2D::create(0, 0);
        $trees = 0;
        for ($y = 0; $y < ($this->getSizeY() - $changeY); $y += $changeY) {
            $position = $position->moveDown($changeY)->moveRight($changeX);
            // printf("Checking: %d, %d: %s\n", $position->getX(), $position->getY(), $this->getAtPosition($position->getX(), $position->getY()));
            if ($this->isTreeAtPosition($position->getX(), $position->getY())) {
                $trees++;
            }
        }
        return $trees;
    }

    /**
     * @return int
     */
    public function getSizeY(): int
    {
        return $this->sizeY;
    }

    public function getAtPosition(int $x, int $y): string
    {
        $x = $x >= $this->sizeX ? $x % $this->sizeX : $x;
        return $this->map[$y][$x];
    }

    public function isTreeAtPosition(int $x, int $y): bool
    {
        return $this->getAtPosition($x, $y) === self::TREE;
    }

}
