<?php

declare(strict_types=1);

namespace CityMap;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

final class MapPositionTest extends TestCase
{

    public function testTurnLeft()
    {
        $map = new MapPosition();

        assertEquals(MapPosition::LOOK_NORTH, $map->getOrientation());
        $map->turnLeft();
        assertEquals(MapPosition::LOOK_WEST, $map->getOrientation());
        $map->turnLeft();
        assertEquals(MapPosition:: LOOK_SOUTH, $map->getOrientation());
        $map->turnLeft();
        assertEquals(MapPosition:: LOOK_EAST, $map->getOrientation());
        $map->turnLeft();
        assertEquals(MapPosition:: LOOK_NORTH, $map->getOrientation());
    }

    public function testTurnRight()
    {
        $map = new MapPosition();

        assertEquals(MapPosition::LOOK_NORTH, $map->getOrientation());
        $map->turnRight();
        assertEquals(MapPosition::LOOK_EAST, $map->getOrientation());
        $map->turnRight();
        assertEquals(MapPosition::LOOK_SOUTH, $map->getOrientation());
        $map->turnRight();
        assertEquals(MapPosition::LOOK_WEST, $map->getOrientation());
        $map->turnRight();
        assertEquals(MapPosition::LOOK_NORTH, $map->getOrientation());
    }
}
