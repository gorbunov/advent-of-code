<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
$guestlist = [
    'Alice would gain 54 happiness units by sitting next to Bob.',
    'Alice would lose 79 happiness units by sitting next to Carol.',
    'Alice would lose 2 happiness units by sitting next to David.',
    'Bob would gain 83 happiness units by sitting next to Alice.',
    'Bob would lose 7 happiness units by sitting next to Carol.',
    'Bob would lose 63 happiness units by sitting next to David.',
    'Carol would lose 62 happiness units by sitting next to Alice.',
    'Carol would gain 60 happiness units by sitting next to Bob.',
    'Carol would gain 55 happiness units by sitting next to David.',
    'David would gain 46 happiness units by sitting next to Alice.',
    'David would lose 7 happiness units by sitting next to Bob.',
    'David would gain 41 happiness units by sitting next to Carol.',
];
$guestlist = file('./guestlist.txt', FILE_IGNORE_NEW_LINES);

$relations = new \Guests\RelationsList();
foreach ($guestlist as $line) {
    $relations->parse($line);
}

$seatings = $relations->getSeatings();
$happiness = array_map(
    static function (\Guests\Seating $seating) {
        return $seating->getHappiness();
    },
    $seatings
);
$max = max($happiness);
printf("Max happiness: %d\n", $max);
