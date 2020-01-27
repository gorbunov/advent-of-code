<?php declare(strict_types=1);


namespace Repairing;


final class Direction
{
    public const NORTH = 1;
    public const SOUTH = 2;
    public const WEST = 3;
    public const EAST = 4;

    private static $turns = [
        self::NORTH => self::EAST,
        self::EAST  => self::SOUTH,
        self::SOUTH => self::WEST,
        self::WEST  => self::NORTH,
    ];

    private static $rightTurns = [
        self::NORTH => self::WEST,
        self::EAST  => self::NORTH,
        self::SOUTH => self::EAST,
        self::WEST  => self::SOUTH,
    ];


    private static $names = [
        self::NORTH => 'N',
        self::SOUTH => 'S',
        self::WEST  => 'W',
        self::EAST  => 'E',
    ];

    public static function turn(int $direction): int
    {
        return self::$turns[$direction];
    }

    public static function name(int $direction): string
    {
        return self::$names[$direction];
    }
}
