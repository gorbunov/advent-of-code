<?php declare(strict_types=1);
require_once __DIR__ . '/../shared/autoload.php';

$program = trim(file_get_contents('./program.txt', false));
$cpu = \IntCode\IntCodeComputer::load($program);
