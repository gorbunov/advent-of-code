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
    private $score = 0;
    private $paddle = -33;
    private $ball = -77;

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

    public function draw(int $x, int $y, int $tile): self
    {
        if (($x === -1) && $y === 0) {
            return $this->updateScore($tile);
        }
        $this->display[$y][$x] = self::$mapping[$tile];
        $this->tiles[$y][$x] = $tile;
        $this->counts[$tile] += 1;
        if ($tile === 3) {
            $this->paddle = $x;
        }
        if ($tile === 4) {
            $this->ball = $x;
        }
        return $this;
    }

    private function updateScore(int $score): self
    {
        $this->score = $score;
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

    public function score(): int
    {
        return $this->score;
    }

    public function blocks(): int
    {
        return $this->counts[2];
    }

    public function ball(): int
    {
        return $this->ball;
    }

    public function paddle(): int
    {
        return $this->paddle;
    }
}
