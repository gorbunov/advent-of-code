<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$aunts = file('./aunts.txt', FILE_IGNORE_NEW_LINES);
$matches = [
    'children'    => 3,
    'cats'        => 7,
    'samoyeds'    => 2,
    'pomeranians' => 3,
    'akitas'      => 0,
    'vizslas'     => 0,
    'goldfish'    => 5,
    'trees'       => 3,
    'cars'        => 2,
    'perfumes'    => 1,
];
$matcher = new \Aunts\Matcher();
foreach ($aunts as $aunt) {
    $matcher->addAunt(\Aunts\Sue::parse($aunt));
}

var_dump($matcher->match($matches));
