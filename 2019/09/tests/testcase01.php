<?php declare(strict_types=1);
require_once __DIR__.'/../../shared/autoload.php';

$fixtures = [
    ['in' => '104,1125899906842624,99', 'out' => '1125899906842624'],
    ['in' => '1102,34915192,34915192,7,4,7,99,0', 'out' => '1219070632396864'],
    ['in' => '109,1,204,-1,1001,100,1,100,1008,100,16,101,1006,101,0,99', 'out' => '109,1,204,-1,1001,100,1,100,1008,100,16,101,1006,101,0,99'],
];

foreach ($fixtures as $i => $fixture) {
    $in = $fixture['in']; $out = $fixture['out'];
    printf("Running program #%d\n", $i);
    $cpu = \IntCode\IntCodeComputer::load($in, \IntCode\Program\InputFactory::empty());
    $cpu = $cpu->run();
    $output = $cpu->output()->outputs();
    print_array_values($output);
    assert($output[0] === (int)$out);
}

