<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$program = file_get_contents('./program.txt', false);

$cpu = \IntCode\IntCodeComputer::load($program);
$program = $cpu->run(function (\IntCode\Program $program) {
    $program->input()->insert(1);
    return $program;
});

printf("BOOST keycode: %d\n", $program->output()->outputs()[0]);

$program = $cpu->run(function (\IntCode\Program $program) {
    $program->input()->insert(2);
    return $program;
});

printf("Distress code: %d\n", $program->output()->outputs()[0]);
