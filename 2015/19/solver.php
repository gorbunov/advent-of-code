<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$rawReplacements = file('./replacements.txt', FILE_IGNORE_NEW_LINES);
$molecule = trim(file_get_contents('./molecule.txt', false));

$rawReplacements = [
    'e => H',
    'e => O',
    'H => HO',
    'H => OH',
    'O => HH',
];
$molecule = 'HOHOHOHOHO';

$machine = new \Medicine\MedsMachine($molecule);
$replacements = [];

foreach ($rawReplacements as $replacement) {
    [$key, $value] = explode(' => ', $replacement);
    $machine->learnReplacement($value, $key);
}
var_dump($machine->reduce($molecule, 1));
//var_dump($machine->getCombinations());

//printf("Found %d combinations.\n", count($machine->getCombinations()));

