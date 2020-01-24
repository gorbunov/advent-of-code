<?php declare(strict_types=1);
require_once __DIR__. '/../shared/autoload.php';
$program = file_get_contents('./program.txt', false);

$arcade = \Arcade\Cabinet::create($program);
//var_dump($arcade->play()->screen());
print $arcade->play()->screen()->show();
print_array_values($arcade->screen()->counts());
