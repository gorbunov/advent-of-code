<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$rawReplacements = file('./replacements.txt', FILE_IGNORE_NEW_LINES);
$molecule = trim(file_get_contents('./molecule.txt', false));

/*
$rawReplacements = [
    'H => HO',
    'H => OH',
    'O => HH',
];
$molecule = 'HOH';
*/
$machine = new \Medicine\MedsMachine($molecule);
$replacements = [];

foreach ($rawReplacements as $replacement) {
    [$key, $value] = explode(' => ', $replacement);
    $machine->learnReplacement($key, $value);
}
// var_dump($machine);
// var_dump($machine->getCombinations());
printf("Found %d combinations.\n", count($machine->getCombinations()));

