<?php declare(strict_types=1);
require_once __DIR__.'/../../shared/autoload.php';

$fixtures = [
    112233 => true,
    123444 => false,
    111122 => true,
];

$validator = \Validator\Validator::create(
    [
        \Validator\Rules\DigitsCount::create(6),
        // \Validator\Rules\Range::create(254032, 789860),
        \Validator\Rules\DigitsIncrease::create(),
        \Validator\Rules\HasDoubleDigits::create(),
        \Validator\Rules\ExactlyDoubleDigitsGroupExists::create()
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
