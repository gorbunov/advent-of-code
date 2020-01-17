<?php declare(strict_types=1);

use IntCode\Program\Input;
use IntCode\IntCodeRunner;

require_once __DIR__.'/../../shared/autoload.php';

$fixtures = [
    '1,0,0,0,99'                    => '2,0,0,0,99',
    '2,3,0,3,99'                    => '2,3,0,6,99',
    '2,4,4,5,99,0'                  => '2,4,4,5,99,9801',
    '1,1,1,4,99,5,6,0,99'           => '30,1,1,4,2,5,6,0,99',
    '1,9,10,3,2,3,11,0,99,30,40,50' => '3500,9,10,70,2,3,11,0,99,30,40,50',
];

$i = 0;
foreach ($fixtures as $input => $expected) {
    $i++;
    $result = (string)IntCodeRunner::fromCodeString($input, Input::empty())->run()->program();
    if (assert($expected === $result, sprintf('Test #%d: Expected: %s, Result: %s', $i, $expected, $result))) {
        printf("Test #%d succeeded.\n", $i);
    }
}
