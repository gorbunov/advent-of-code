<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$bossDef = file_get_contents('./boss.txt');
$boss = \Rpg\Boss::create($bossDef);
$player = new \Rpg\Player('Player', 100, 100);
/*
$boss = \Rpg\Boss::create("Hit Points: 12 Damage: 7 Armor: 2");
$player = new \Rpg\Player('Player', 8, 8);
$player->wearEquipment(\Rpg\BossEquipment::create(5, 5));
*/
$sets = \Rpg\NpcStore::getCombinations();
var_dump($sets);
$arena = \Rpg\Battle::create([$player, $boss]);
$cheapest = PHP_INT_MAX;
$priciest = 0;
foreach ($sets as $eqSet) {
    $eqSet->wearOn($player);
    $arena->battle();
    if ($arena->didPlayerWon()) {
        $cheapest = min($eqSet->getTotalPrice(), $cheapest);
    } else {
        $priciest = max($eqSet->getTotalPrice(), $priciest);
    }
    $arena->reset();
}
printf("Cheapest winning set: %d\n", $cheapest);
printf("Priciest losing set: %d\n", $priciest);
/*
printf("Player is %s; Boss is %s.\n", $player->isAlive() ? 'alive' : 'dead', $boss->isAlive() ? 'alive' : 'dead');
printf("Player %s.\n", $arena->didPlayerWon() ? 'did won' : 'has been defeated');
*/
