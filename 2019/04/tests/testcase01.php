<?php declare(strict_types=1);
require_once __DIR__.'/../../shared/autoload.php';

$fixtures = [
    111111 => true,
    223450 => false,
    123789 => false,
    122345 => true,
    111123 => true,
    135679 => false,
];

$validator = \Validator\Validator::create(
    [
        \Validator\Rules\DigitsCount::create(6),
        // \Validator\Rules\Range::create(254032, 789860),
        \Validator\Rules\DigitsIncrease::create(),
        \Validator\Rules\HasDoubleDigits::create(),
    ]
);

$i = 0;
foreach ($fixtures as $fixture => $expected) {
    $i++;
    $result = $validator->validate($fixture);
    assert($expected === $result, sprintf("Test #%d failed: Expected %s, got %s for %d; Validator: %s\n",
                                          $i,
                                          $expected?'true':'false',
                                          $result?'true':'false',
                                          $fixture,
                                            $validator->error()
    ));
}
