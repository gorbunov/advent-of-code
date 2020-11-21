<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
$reindeers = [
    'Comet can fly 14 km/s for 10 seconds, but then must rest for 127 seconds.',
    'Dancer can fly 16 km/s for 11 seconds, but then must rest for 162 seconds.',
];
$reindeers = file('./reindeers.txt', FILE_IGNORE_NEW_LINES);

$reindeerList = \Reindeers\ReindeerList::create();

foreach ($reindeers as $reindeer) {
    $reindeerList->parse($reindeer);
}

printf("Winner traveled %d\n", max($reindeerList->traveledAfter(2503)));

$leaderboard = \Reindeers\Leaderboard::create();

for ($i = 1; $i <= 2503; $i++) {
    $leaders = $reindeerList->leadersAtTime($i);
    foreach ($leaders as $leader) {
        $leaderboard->addPoint($leader);
    }
}

var_dump($leaderboard);
