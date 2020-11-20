<?php declare(strict_types=1);

namespace Christmas;

use Christmas\LightsGrid\Command;

final class LightsGrid
{
    public const LIGHT_ON = 1;
    public const LIGHT_OFF = 0;

    private array $lights;

    public static function create(): self
    {
        return new self();
    }

    private function __construct()
    {
        $this->lights = [];
        for ($x = 0; $x < 1000; $x++) {
            $this->lights[$x] = [];
            for ($y = 0; $y < 1000; $y++) {
                $this->lights[$x][$y] = 0;
            }
        }
    }

    public function getLight(int $x, int $y): int
    {
        return $this->lights[$x][$y];
    }

    public function setLight(int $x, int $y, int $state): self
    {
        $this->lights[$x][$y] = $state;
        return $this;
    }

    public function setLightOn(int $x, int $y): self
    {
        return $this->setLight($x, $y, self::LIGHT_ON);
    }

    public function setLightOff(int $x, int $y): self
    {
        return $this->setLight($x, $y, self::LIGHT_OFF);
    }

    public function toggleLight(int $x, int $y): self
    {
        return $this->setLight($x, $y, (int)!$this->getLight($x, $y));
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


    public function countPoweredLights(): int
    {
        $turnedOn = 0;
        foreach ($this->lights as $row) {
            $turnedOn += array_sum($row);
        }
        return $turnedOn;
    }
}
