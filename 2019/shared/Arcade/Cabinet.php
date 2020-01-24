<?php declare(strict_types=1);

namespace Arcade;

use IntCode\IntCodeRunner;

final class Cabinet
{
    /**
     * @var IntCodeRunner
     */
    private $cpu;
    /**
     * @var Screen
     */
    private $screen;
    /**
     * @var Joystick
     */
    private $joystick;

    public static function create(string $program): self
    {
        $screen = Screen::create();
        $joystick = Joystick::create($screen);
        return new self(IntCodeRunner::fromCodeString($program, $joystick), $screen, $joystick);
    }

    private function __construct(IntCodeRunner $cpu, Screen $screen, Joystick $joystick)
    {
        $this->cpu = $cpu;
        $this->screen = $screen;
        $this->joystick = $joystick;
    }

    public function cpu(): IntCodeRunner
    {
        return $this->cpu;
    }

    public function screen(): Screen
    {
        return $this->screen;
    }

    public function joystick(): Joystick
    {
        return $this->joystick;
    }

    public function money(int $money)
    {
        $this->cpu->program()->alter(0, $money);
        return $this;
    }

    public function play(int $money = 1): self
    {
        $this->money($money);
        /*
        $output = $this->cpu->run()->program()->output()->outputs();
        foreach (array_chunk($output, 3) as [$x, $y, $tile]) {
            $this->screen->draw($x, $y, $tile);
        }
        */
        while (!$this->cpu->halted()) {
            $outputs = [];
            foreach (range(0, 2) as $inter) {
                if ($this->cpu->untilOutput()) {
                    return $this; // interrupted
                }
                $outputs[] = $this->cpu->program()->output()->pop();
            }
            $this->screen->draw(...$outputs);
        }

        return $this;
    }

    public function blocks(): int
    {
        return $this->screen->blocks();
    }

    public function score(): int
    {
        return $this->screen->score();
    }
}
