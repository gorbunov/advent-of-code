<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$bossDef = file_get_contents('./boss.txt');
// $boss = \Rpg\Boss::create($bossDef);
//$player = new \Rpg\Player('Player', 100, 100);
$boss = \Rpg\Boss::create("Hit Points: 12 Damage: 7 Armor: 2");
$player = new \Rpg\Player('Player', 8, 8);

$player->wearEquipment(\Rpg\BossEquipment::create(5, 5));
$arena = \Rpg\Battle::create([$player, $boss]);
$arena->battle();
printf("Player is %s; Boss is %s.\n", $player->isAlive() ? 'alive' : 'dead', $boss->isAlive() ? 'alive' : 'dead');
printf("Player %s.\n", $arena->didPlayerWon() ? 'did won' : 'has been defeated');
//var_dump($arena);
