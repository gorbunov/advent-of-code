<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$rules = file('./rules.txt', FILE_IGNORE_NEW_LINES);

$valid = 0;
$validPositions = 0;
foreach ($rules as $passline) {
    [$rule, $password] = explode(':', $passline);
    $policy = \Passwords\Policy::parse(trim($rule));
    if ($policy->isValid(trim($password))) {
        $valid++;
    }
    if ($policy->isValidPositionally(trim($password))) {
        $validPositions++;
    }
}

printf("Valid passwords count: %d\n", $valid);
printf("Positionally valid passwords count: %d\n", $validPositions);
