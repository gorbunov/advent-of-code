<?php declare(strict_types=1);

require_once __DIR__.'/../shared/autoload.php';

$directions = str_split(trim(file_get_contents('./directions.txt')), 1);
$locations = new CityHouses();

$startingPoint = Position2D::create(0, 0);
$santa = Santa::createAtPosition($startingPoint);
$locations->visit($startingPoint);

foreach ($directions as $direction) {
    switch ($direction) {
        case '^':
            $santa->moveNorth();
            break;
        case 'v':
            $santa->moveSouth();
            break;
        case '<':
            $santa->moveWest();
            break;
        case '>':
            $santa->moveEast();
            break;
    }
    /** @noinspection DisconnectedForeachInstructionInspection */
    $locations->visit($santa->getPosition());
}

printf("Houses visited: %d\n", $locations->getVisitedHousesCount());
