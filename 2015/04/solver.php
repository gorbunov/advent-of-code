<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
$secret = 'yzbqklnj';

$hasher5 = \AdventCoin\Hasher::create($secret, 5);
$hasher6 = \AdventCoin\Hasher::create($secret, 6);

$value = 0;
$coin5 = 0;
$coin6 = 0;
while (!($coin5 && $coin6)) {
    if (!$coin5 && $hasher5->isCoinHash((string)$value)) {
        $coin5 = $value;
    }
    if (!$coin6 && $hasher6->isCoinHash((string)$value)) {
        $coin6 = $value;
    }
    $value++;
}
printf("Lowest 5 hashing number: %d\n", $coin5);
printf("Lowest 6 hashing number: %d\n", $coin6);
