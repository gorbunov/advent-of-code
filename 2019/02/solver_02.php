<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$memory = trim(file_get_contents('./program.txt', false));
$cpu = \IntCode\IntCodeComputer::load($memory);
$solution = 0;
for ($noun = 0; $noun < 100; $noun++) {
    for ($verb = 0; $verb < 100; $verb++) {
        $result = $cpu->run(
            function (\IntCode\Program $program) use ($noun, $verb) {
                $program->alter(1, $noun);
                $program->alter(2, $verb);
                return $program;
            }
        );
        if ($result->read(0) === 19690720) {
            $solution = 100 * $noun + $verb;
            break 2;
        }
    }
}

printf("Code: \n");
printf("%s\n", $solution);
