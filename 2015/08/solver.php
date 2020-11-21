<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$santalist = [
    '""',
    '"abc"',
    '"aaa\"aaa"',
    '"\x27"',

];
$santalist = file('./santalist.txt', FILE_IGNORE_NEW_LINES);

$raw = 0;
$evald = 0;
foreach ($santalist as $line) {
    $raw += strlen($line);
    $parsed = \SantaList\StringEval::parse($line);
    $evald += strlen($parsed);
}

printf('Memory usage: (%d - %d) = %d', $raw, $evald, $raw - $evald);
