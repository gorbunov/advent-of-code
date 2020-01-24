<?php declare(strict_types=1);

namespace Arcade;

use IntCode\IntCodeComputer;

final class Cabinet
{
    /**
     * @var IntCodeComputer
     */
    private $cpu;
    /**
     * @var Screen
     */
    private $screen;

    public static function create(string $program): self
    {
        return new self(IntCodeComputer::load($program), Screen::create());
    }

    private function __construct(IntCodeComputer $cpu, Screen $screen)
    {
        $this->cpu = $cpu;
        $this->screen = $screen;
    }

    public function cpu(): IntCodeComputer
    {
        return $this->cpu;
    }

    public function screen(): Screen
    {
        return $this->screen;
    }

    public function play(): self
    {
        $output = $this->cpu->run()->output()->outputs();
        foreach (array_chunk($output, 3) as [$x, $y, $tile]) {
            $this->screen->draw($x, $y, $tile);
        }
        return $this;
    }
}
