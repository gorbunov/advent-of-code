<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$load = file('./program.txt');
//$load = file('./demo.txt');

$runner = \AsmRunner\Runner:: create();
$program = \AsmRunner\Program::parse($load);
$haltState = $runner->run($program);

var_dump($haltState);
