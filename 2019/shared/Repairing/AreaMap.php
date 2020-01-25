<?php declare(strict_types=1);

namespace Repairing;


final class AreaMap
{
    public const WALL = 0;
    public const EMPTY = 1;
    public const FOUND = 2;

    private static $sprites = [
        self::WALL  => '█',
        self::EMPTY => ' ',
        self::FOUND => '#',
    ];
    /**
     * @var array
     */
    private $tiles;

    private function __construct()
    {
        $this->tiles = [];
    }

    public static function create(): AreaMap
    {
        return new self();
    }

    public static function sprite(int $status): string
    {
        return self::$sprites[$status];
    }

    public function mark(Position $position, int $type): self
    {
        $this->tiles[$position->y()][$position->x()] = $type;
        return $this;
    }

    public function __toString()
    {
        $display = '';

        foreach ($this->tiles as $y => $row) {
            $display .= implode('', $row)."\n";
        }

        return $display;
    }

}
