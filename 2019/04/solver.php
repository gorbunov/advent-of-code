<?php declare(strict_types=1);

use Validator\Validator;
use Validator\Rules\Range;
use Validator\Rules\DigitsCount;
use Validator\Rules\DigitsIncrease;
use Validator\Rules\HasDoubleDigits;
use Validator\Rules\ExactlyDoubleDigitsGroupExists;

require_once __DIR__.'/../shared/autoload.php';
$range = file_get_contents('./range.txt');
$range = explode('-', $range);
$range = array_map('\intval', $range);

$rules = [
    DigitsCount::create(6),
    Range::create(...$range),
    DigitsIncrease::create(),
    HasDoubleDigits::create(),
];
$validator = Validator::create($rules);
$rules[] = ExactlyDoubleDigitsGroupExists::create();
$validator2 = Validator::create($rules);
$valid = 0;
$valid2 = 0;
for ($password = $range[0]; $password <= $range[1]; $password++) {
    if ($validator->validate($password)) {
        $valid++;
    }
    if ($validator2->validate($password)) {
        $valid2++;
    }
}

print_array_values($range);

printf("Valid passwords #01 count: %d\n", $valid);
printf("Valid passwords #02 count: %d\n", $valid2);
