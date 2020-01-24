<?php declare(strict_types=1);

namespace Arcade;

final class Screen
{
    private static $mapping = [
        0 => ' ',
        1 => '█',
        2 => '▒',
        3 => '▄',
        4 => '▢',
    ];
    /**
     * @var array
     */
    private $display;
    private $tiles;
    private $counts;

    public static function create(): self
    {
        return new self();
    }

    private function __construct()
    {
        $this->display = [];
        $this->tiles = [];
        foreach (self::$mapping as $type => $block) {
            $this->counts[$type] = 0;
        }
    }

    public function draw(int $x, int $y, int $tile)
    {
        $this->display[$y][$x] = self::$mapping[$tile];
        $this->tiles[$y][$x] = $tile;
        $this->counts[$tile] += 1;
        return $this;
    }

    public function show()
    {
        $display = '';
        foreach ($this->display as $y => $row) {
            $display .= sprintf("%s\n", implode('', $row));
        }
        return $display;
    }

    public function counts(): array
    {
        return $this->counts;
    }
}
