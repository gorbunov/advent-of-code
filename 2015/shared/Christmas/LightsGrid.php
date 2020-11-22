<?php declare(strict_types=1);

namespace Christmas;

use Christmas\LightsGrid\Command;

final class LightsGrid
{
    public const LIGHT_ON = 1;
    public const LIGHT_OFF = 0;

    private array $lights;
    private int $sizeX;
    private int $sizeY;

    private function __construct(int $sizeX, int $sizeY)
    {
        $this->lights = [];
        for ($x = 0; $x < $sizeX; $x++) {
            $this->lights[$x] = [];
            for ($y = 0; $y < $sizeY; $y++) {
                $this->lights[$x][$y] = 0;
            }
        }
        $this->sizeX = $sizeX;
        $this->sizeY = $sizeY;
    }

    public static function create(int $sizeX, int $sizeY): self
    {
        return new self($sizeX, $sizeY);
    }

    public function apply(Command $command): self
    {
        $area = $command->getRectangle();
        switch ($command->getOperation()) {
            case Command::TURN_ON:
                $area->each(
                    function ($x, $y) {
                        $this->setLightOn($x, $y);
                    }
                );
                break;
            case Command::TURN_OFF:
                $area->each(
                    function ($x, $y) {
                        $this->setLightOff($x, $y);
                    }
                );
                break;
            case Command::TURN_TOGGLE:
                $area->each(
                    function ($x, $y) {
                        $this->toggleLight($x, $y);
                    }
                );
                break;
            default:
                throw new \RuntimeException('Unsupported command');
        }
        return $this;
    }

    public function setLightOn(int $x, int $y): self
    {
        return $this->setLight($x, $y, self::LIGHT_ON);
    }

    public function setLight(int $x, int $y, int $state): self
    {
        $this->lights[$x][$y] = $state;
        return $this;
    }

    public function setLightOff(int $x, int $y): self
    {
        return $this->setLight($x, $y, self::LIGHT_OFF);
    }

    public function toggleLight(int $x, int $y): self
    {
        return $this->setLight($x, $y, (int)!$this->getLight($x, $y));
    }

    public function getLight(int $x, int $y): int
    {
        /* OFF if outside of grid */
        return $this->lights[$x][$y] ?? self::LIGHT_OFF;
    }

    public function applyBrightness(Command $command): self
    {
        $area = $command->getRectangle();
        switch ($command->getOperation()) {
            case Command::TURN_ON:
                $area->each(
                    function ($x, $y) {
                        $this->incBrightness($x, $y, 1);
                    }
                );
                break;
            case Command::TURN_OFF:
                $area->each(
                    function ($x, $y) {
                        $this->decBrightness($x, $y);
                    }
                );
                break;
            case Command::TURN_TOGGLE:
                $area->each(
                    function ($x, $y) {
                        $this->incBrightness($x, $y, 2);
                    }
                );
                break;
            default:
                throw new \RuntimeException('Unsupported command');
        }
        return $this;
    }

    public function incBrightness(int $x, int $y, int $increment): self
    {
        $this->setLight($x, $y, $this->getLight($x, $y) + $increment);
        return $this;
    }

    public function decBrightness(int $x, int $y): self
    {
        $brightness = max(0, $this->getLight($x, $y) - 1);
        $this->setLight($x, $y, $brightness);
        return $this;
    }

    public function countPoweredLights(): int
    {
        $turnedOn = 0;
        foreach ($this->lights as $row) {
            $turnedOn += array_sum($row);
        }
        return $turnedOn;
    }

    public function reset()
    {
        for ($x = 0; $x < $this->sizeX; $x++) {
            for ($y = 0; $y < $this->sizeY; $y++) {
                $this->setLightOff($x, $y);
            }
        }
    }

    public function getStateChange(int $x, int $y): int
    {
        $nbghs = [
            // straight neighbours
            $this->getLight($x - 1, $y),
            $this->getLight($x + 1, $y),
            $this->getLight($x, $y - 1),
            $this->getLight($x, $y + 1),
            // diagonals
            $this->getLight($x - 1, $y - 1),
            $this->getLight($x + 1, $y + 1),
            $this->getLight($x + 1, $y - 1),
            $this->getLight($x - 1, $y + 1),

        ];
        if ($this->getLight($x, $y) === self::LIGHT_ON) {
            $newState = \in_array(array_sum($nbghs), [2, 3], true) ? self::LIGHT_ON : self::LIGHT_OFF;
        } else {
            $newState = array_sum($nbghs) === 3 ? self::LIGHT_ON : self::LIGHT_OFF;
        }
        /// printf("(%d, %d), s: %d > %d, n: %d (%s)\n", $x, $y, $this->getLight($x, $y), $newState, array_sum($nbghs), implode(', ', $nbghs));
        return $newState;
    }

    public function printState()
    {
        $map = '';
        for ($x = 0; $x < $this->sizeX; $x++) {
            $map .= implode($this->lights[$x])."\n";
        }
        print str_replace(['1', '0'], ['#', '.'], $map);
    }
}
