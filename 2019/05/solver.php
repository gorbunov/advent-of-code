<?php declare(strict_types=1);

use IntCode\Program\Input;
use IntCode\IntCodeComputer;

require_once __DIR__.'/../shared/autoload.php';

$program = trim(file_get_contents('./program.txt'));
$input = Input::create([1]);
$cpu = IntCodeComputer::load($program, $input);

$output = $cpu->run()->output();

print_array_values($output->outputs());
