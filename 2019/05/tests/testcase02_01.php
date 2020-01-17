<?php declare(strict_types=1);

use IntCode\Program\Input;
use IntCode\IntCodeRunner;

require_once __DIR__.'/../../shared/autoload.php';
$fixtures = [
    '3,9,8,9,10,9,4,9,99,-1,8'                 => [2 => 0, 6 => 0, 8 => 1, 22 => 0, 0 => 0], // pos
    '3,9,7,9,10,9,4,9,99,-1,8'                 => [2 => 1, 6 => 1, 8 => 0, 22 => 0, 0 => 1],
    '3,3,1108,-1,8,3,4,3,99'                   => [2 => 0, 6 => 0, 8 => 1, 22 => 0, 0 => 0],
    '3,3,1107,-1,8,3,4,3,99'                   => [2 => 1, 6 => 1, 8 => 0, 22 => 0, 0 => 1],
    '3,12,6,12,15,1,13,14,13,4,13,99,-1,0,1,9' => [0 => 0, 2 => 1, 6 => 1, 33 => 1],
    '3,3,1105,-1,9,1101,0,0,12,4,12,99,1'      => [0 => 0, 2 => 1, 6 => 1, 33 => 1],
];

$progNum = 0;
foreach ($fixtures as $program => $tests) {
    $progNum++;
    printf("Program #%d\n", $progNum);
    $testCase = 0;
    foreach ($tests as $input => $expected) {
        $testCase++;
        $cr = IntCodeRunner::fromCodeString($program, Input::create([$input]))->run();
        $result = $cr->program()->output()->outputs()[0];
        if (assert($expected === $result, sprintf('Test #%d for Program #%d: Expected: %s, Result: %s', $testCase, $progNum, $expected, $result))) {
            printf("Test #%d for Program #%d succeeded.\n", $testCase, $progNum);
        }
    }
}
