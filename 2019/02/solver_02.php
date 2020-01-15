<?php declare(strict_types=1);
require_once __DIR__ . '/../shared/autoload.php';

$program = trim(file_get_contents('./program.txt', false));
$cpu = \IntCode\IntCodeComputer::load($program);

$result = $cpu->run(static function(\IntCode\Program $program) {
    $program->alter(1, 12);
    $program->alter(2, 2);
    return $program;
});

printf("Code: \n");
printf("%s\n", $result->read(0));
