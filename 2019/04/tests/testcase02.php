<?php declare(strict_types=1);

use Validator\Validator;
use Validator\Rules\DigitsCount;
use Validator\Rules\DigitsIncrease;
use Validator\Rules\HasDoubleDigits;
use Validator\Rules\ExactlyDoubleDigitsGroupExists;

require_once __DIR__.'/../../shared/autoload.php';

$fixtures = [
    112233 => true,
    123444 => false,
    111122 => true,
];

$validator = Validator::create(
    [
        DigitsCount::create(6),
        // \Validator\Rules\Range::create(254032, 789860),
        DigitsIncrease::create(),
        HasDoubleDigits::create(),
        ExactlyDoubleDigitsGroupExists::create()
    ]
);

$i = 0;
foreach ($fixtures as $fixture => $expected) {
    $i++;
    $result = $validator->validate($fixture);
    assert(
        $expected === $result,
        sprintf(
            "Test #%d failed: Expected %s, got %s for %d; Validator: %s\n",
            $i,
            $expected ? 'true' : 'false',
            $result ? 'true' : 'false',
            $fixture,
            $validator->error()
        )
    );
}
