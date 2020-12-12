<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$bootcode = file('./bootcode.txt', FILE_IGNORE_NEW_LINES);
// $bootcode = file('./bootcode-example.txt', FILE_IGNORE_NEW_LINES);

$console = new \Handheld\Console();

$program = \Handheld\Code\Program::load($bootcode);
$console->run($program);

printf("Mem acc is %d\n", $console->getAcc());

$console->runUntilNotHalted($program);

printf("Mem acc with unhalted fix is %d\n", $console->getAcc());
