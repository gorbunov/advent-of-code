<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
$program = file_get_contents('./program.txt', false);

$arcade = \Arcade\Cabinet::create($program);
//var_dump($arcade->play()->screen());
//print $arcade->play()->screen()->show();
printf("Blocks count: %d\n", $arcade->play()->blocks()); //452

$arcade = \Arcade\Cabinet::create($program);
$arcade->play(2);

printf("Final score: %d\n", $arcade->screen()->score()); //21415

