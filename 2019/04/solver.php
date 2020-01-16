<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
$range = file_get_contents('./range.txt');
$range = explode('-', $range);
$range = array_map('\intval', $range);

$validator = \Validator\Validator::create(
    [
        \Validator\Rules\DigitsCount::create(6),
        \Validator\Rules\Range::create(...$range),
        \Validator\Rules\DigitsIncrease::create(),
        \Validator\Rules\HasDoubleDigits::create()
    ]
);
$valid = 0;
for ($password = $range[0]; $password <= $range[1]; $password++) {
    if ($validator->validate($password)){
        $valid++;
    }
}

print_array_values($range);
printf("Valid passwords count: %d\n", $valid);
