<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$routes = [
    'London to Dublin = 464',
    'London to Belfast = 518',
    'Dublin to Belfast = 141',
];
$routes = file('./directions.txt', FILE_IGNORE_NEW_LINES);

$navigation = new \Navigation\RouteMap();

foreach ($routes as $route) {
    $navigation->addRoute(\Navigation\NavRoute::parse($route));
}
printf("Combitations of %d by %d\n", $navigation->getLocationsCount(), $navigation->getRoutesCount());
printf("Routing Count: %d\n", $navigation->getRoutingsCount());
printf("Shortest distance: %d\n", $navigation->getShortestDistance());
printf("Longest distance: %d\n", $navigation->getLongestDistance());

// var_dump($navigation->getLocationsPermutations());
// var_dump($navigation->getAlldistances());
