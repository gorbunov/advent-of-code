<?php declare(strict_types=1);

namespace Keypad;

final class DiamondKeypad implements Keypad
{
    private const DIR_DOWN = 'down';
    private const DIR_UP = 'up';
    private const DIR_LEFT = 'left';
    private const DIR_RIGHT = 'right';

    private string $position = '5';
    private array $movement = [
        '1' => [
            self::DIR_DOWN => '3',
        ],
        '2' => [
            self::DIR_RIGHT  => '3',
            self::DIR_DOWN => '6',
        ],
        '3' => [
            self::DIR_UP    => '1',
            self::DIR_DOWN  => '7',
            self::DIR_LEFT  => '2',
            self::DIR_RIGHT => '4',
        ],
        '4' => [
            self::DIR_DOWN => '8',
            self::DIR_LEFT => '3',
        ],
        '5' => [
            self::DIR_RIGHT => '6',
        ],
        '6' => [
            self::DIR_UP    => '2',
            self::DIR_DOWN  => 'A',
            self::DIR_LEFT  => '5',
            self::DIR_RIGHT => '7',
        ],
        '7' => [
            self::DIR_UP    => '3',
            self::DIR_DOWN  => 'B',
            self::DIR_LEFT  => '6',
            self::DIR_RIGHT => '8',
        ],
        '8' => [
            self::DIR_UP    => '4',
            self::DIR_DOWN  => 'C',
            self::DIR_LEFT  => '7',
            self::DIR_RIGHT => '9',
        ],
        '9' => [
            self::DIR_LEFT => '8',
        ],
        'A' => [
            self::DIR_UP    => '6',
            self::DIR_RIGHT => 'B',
        ],
        'B' => [
            self::DIR_UP    => '7',
            self::DIR_DOWN  => 'D',
            self::DIR_LEFT  => 'A',
            self::DIR_RIGHT => 'C',
        ],
        'C' => [
            self::DIR_UP   => '8',
            self::DIR_LEFT => 'B',
        ],
        'D' => [
            self::DIR_UP => 'B',
        ],
    ];

    public static function create()
    {
        return new self();
    }

    public function getKeyNum(): string
    {
        return $this->position;
    }

    public function moveUp()
    {
        if (array_key_exists(self::DIR_UP, $this->movement[$this->position])) {
            $this->position = $this->movement[$this->position][self::DIR_UP];
        }
    }

    public function moveDown()
    {
        if (array_key_exists(self::DIR_DOWN, $this->movement[$this->position])) {
            $this->position = $this->movement[$this->position][self::DIR_DOWN];
        }
    }

    public function moveLeft()
    {
        if (array_key_exists(self::DIR_LEFT, $this->movement[$this->position])) {
            $this->position = $this->movement[$this->position][self::DIR_LEFT];
        }
    }

    public function moveRight()
    {
        if (array_key_exists(self::DIR_RIGHT, $this->movement[$this->position])) {
            $this->position = $this->movement[$this->position][self::DIR_RIGHT];
        }
    }
}
