<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$program = file_get_contents('./program.txt', false);

$cpu = \IntCode\IntCodeComputer::load($program, \IntCode\Program\InputFactory::create([1]));
$cpu = $cpu->run();

print_array_values($cpu->output()->outputs());
printf("BOOST keycode: %d\n", $cpu->output()->outputs()[0]);
