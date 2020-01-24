<?php declare(strict_types=1);


namespace Painting\Robot;


class Orientation
{
    public const UP = 'up';
    public const DOWN = 'down';
    public const LEFT = 'left';
    public const RIGHT = 'right';
    private static $turning = [
        self::UP    => [
            self::LEFT  => self::LEFT,
            self::RIGHT => self::RIGHT,
        ],
        self::DOWN  => [
            self::LEFT  => self::RIGHT,
            self::RIGHT => self::LEFT,
        ],
        self::LEFT  => [
            self::LEFT  => self::DOWN,
            self::RIGHT => self::UP,
        ],
        self::RIGHT => [
            self::LEFT  => self::UP,
            self::RIGHT => self::DOWN,
        ],
    ];
    /**
     * @var string
     */
    private $orientation;

    private function __construct(string $orientation)
    {
        $this->orientation = $orientation;
    }

    public static function create(): Orientation
    {
        return new self(self::UP);
    }

    /**
     * @return string
     */
    public function orientation(): string
    {
        return $this->orientation;
    }

    public function turn(string $direction): self
    {
        $this->orientation = self::$turning[$this->orientation][$direction];
        return $this;
    }

}
