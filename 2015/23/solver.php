<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$load = file('./program.txt');
//$load = file('./demo.txt');

$runner = \AsmRunner\Runner:: create();
$program = \AsmRunner\Program::parse($load);
$haltState = $runner->run($program);
printf("Part 01: %d\n", $haltState->getRegistry('b'));

$runner->reset();
$runner->getCpuState()->setRegistry('a', 1);
$haltState = $runner->run($program);
printf("Part 02: %d\n", $haltState->getRegistry('b'));
