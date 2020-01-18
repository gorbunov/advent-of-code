<?php declare(strict_types=1);

use Amplifier\AmplifierStack;

require_once __DIR__ . '/../shared/autoload.php';

$program = file_get_contents('./program.txt');

$stack = AmplifierStack::createLine($program);

$max = 0;

foreach ($stack->permutations([0, 1, 2, 3, 4]) as $permutation) {
    $max = max($stack->run($permutation), $max);
}
printf("Maximum amplified output: %d\n", $max);
