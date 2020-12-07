<?php declare(strict_types=1);

namespace Keypad;

final class MiniKeypad implements Keypad
{
    private int $sizeX = 3;
    private int $sizeY = 3;

    public function __construct()
    {
        $this->position = \Position2D::create(1, 1);
    }

    public function getKeyNum(): string
    {
        return (string)($this->position->getY() * $this->sizeX + $this->position->getX() + 1);
    }

    public function moveUp()
    {
        if ($this->position->getY() > 0) {
            $this->position->moveDown();
        }
    }

    public function moveDown()
    {
        if ($this->position->getY() < $this->sizeY - 1) {
            $this->position->moveUp();
        }
    }

    public function moveLeft()
    {
        if ($this->position->getX() > 0) {
            $this->position->moveLeft();
        }
    }

    public function moveRight()
    {
        if ($this->position->getX() < $this->sizeX - 1) {
            $this->position->moveRight();
        }
    }

    public static function create()
    {
        return new self();
    }
}
