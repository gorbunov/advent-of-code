<?php declare(strict_types=1);
require_once __DIR__ . '/../shared/autoload.php';

$program = trim(file_get_contents('./program.txt', false));
$intCodeReader = \IntCode\IntCodeRunner::fromString($program);
$result = (string)$intCodeReader->run()->program();

printf("Code: \n");
printf("%s\n", $result);
