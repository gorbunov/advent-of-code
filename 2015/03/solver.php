<?php declare(strict_types=1);

require_once __DIR__.'/../shared/autoload.php';

$rawDirections = trim(file_get_contents('./directions.txt'));
$directions = str_split($rawDirections, 1);
$locations = new CityHouses();

$startingPoint = Position2D::create(0, 0);
$santa = Santa::createAtPosition($startingPoint, 'Santa');
$robosanta = Santa::createAtPosition($startingPoint, 'RoboSanta');
$locations->visit($startingPoint)->visit($startingPoint); // both santas visit 1st house
$repo = SantaRepository::create($santa, $robosanta);

foreach ($directions as $direction) {
    $visitor = $repo->getCurrentSanta();
    switch ($direction) {
        case '^':
            $visitor->moveNorth();
            break;
        case 'v':
            $visitor->moveSouth();
            break;
        case '<':
            $visitor->moveWest();
            break;
        case '>':
            $visitor->moveEast();
            break;
    }
    $locations->visit($visitor->getPosition());
    $repo->setNextSanta();
}

printf("Houses visited: %d\n", $locations->getVisitedHousesCount());
