<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$santalist = [
    '""',
    '"abc"',
    '"aaa\"aaa"',
    '"\x27"',

];
$santalist = file('./santalist.txt', FILE_IGNORE_NEW_LINES);

$rawSize = 0;
$evaledSize = 0;
$encodedSize = 0;
foreach ($santalist as $line) {
    $parsed = \SantaList\StringEval::parse($line);
    $encoded = \SantaList\StringEval::encode($line);
    $rawSize += strlen($line);
    $evaledSize += strlen($parsed);
    $encodedSize += strlen($encoded);
}

printf('Memory usage: (%d - %d) = %d, %d', $rawSize, $evaledSize, $rawSize - $evaledSize, $encodedSize - $rawSize);
