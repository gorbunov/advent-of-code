<?php declare(strict_types=1);

namespace Arcade;

use IntCode\Program\Input;

final class Joystick implements Input
{

    /**
     * @var Screen
     */
    private $screen;

    public static function create(Screen $screen): Joystick
    {
        return new self($screen);
    }

    private function __construct(Screen $screen)
    {
        $this->screen = $screen;
    }

    private $accessCount = 0;

    public function read(): ?int
    {
        $this->accessCount++;
        return $this->getDirection();
    }

    public function insert(int $value): Input
    {
        return $this;
    }

    public function reset(): Input
    {
        return $this;
    }

    /**
     * @return int
     */
    public function getAccessCount(): int
    {
        return $this->accessCount;
    }

    private function getDirection(): int
    {
        return ($this->screen->ball() <=> $this->screen->paddle());
    }

}
