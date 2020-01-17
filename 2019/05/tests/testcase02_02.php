<?php declare(strict_types=1);

use IntCode\Program\Input;
use IntCode\IntCodeRunner;

require_once __DIR__.'/../../shared/autoload.php';
$program = '3,21,1008,21,8,20,1005,20,22,107,8,21,20,1006,20,31,1106,0,36,98,0,0,1002,21,125,20,4,20,1105,1,46,104,999,1105,1,46,1101,1000,1,20,4,20,1105,1,46,98,99';
$fixtures = [
    6  => 999,
    8  => 1000,
    11 => 1001,
];

$i = 0;
foreach ($fixtures as $input => $expected) {
    $i++;
    $cr = IntCodeRunner::fromCodeString($program, Input::create([$input]))->run();
    $result = $cr->program()->output()->outputs()[0];
    if (assert($expected === $result, sprintf('Test #%d: Expected: %s, Result: %s', $i, $expected, $result))) {
        printf("Test #%d succeeded.\n", $i);
    }
}
