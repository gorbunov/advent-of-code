<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
$circuits = [
    '123 -> x',
    '456 -> y',
    'x AND y -> d',
    'x OR y -> e',
    'x LSHIFT 2 -> f',
    'y RSHIFT 2 -> g',
    'NOT x -> h',
    'NOT y -> i',
];
$circuits = file('./circuits.txt', FILE_IGNORE_NEW_LINES);

$wiring = \Circuits\Wiring::create();
foreach ($circuits as $circuit) {
    $connection = $wiring->parseConnection($circuit);
}

// $wiring->getState();
$signalA = $wiring->getWireSignal('a');
printf("Wire a signal: %d\n", $signalA);

$bWire = $wiring->getWire('b');
$bWire->setConnection(\Circuits\Connection::create(\Circuits\Gates\SignalValue::create($signalA), $bWire));

$wiring->reset();

printf("Wire a signal: %d\n", $wiring->getWireSignal('a'));
