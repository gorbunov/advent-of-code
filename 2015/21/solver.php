<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$bossDef = file_get_contents('./boss.txt');
$boss = \Rpg\Boss::create($bossDef);
$boss = \Rpg\Boss::create("Hit Points: 12 Damage: 7 Armor: 2");

var_dump($boss);
