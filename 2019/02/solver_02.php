<?php declare(strict_types=1);

use IntCode\Program;
use IntCode\IntCodeComputer;

require_once __DIR__.'/../shared/autoload.php';

$memory = trim(file_get_contents('./program.txt', false));
$cpu = IntCodeComputer::load($memory, Program\InputFactory::empty());
$solution = 0;
for ($noun = 0; $noun < 100; $noun++) {
    for ($verb = 0; $verb < 100; $verb++) {
        $result = $cpu->run(
            static function (Program $program) use ($noun, $verb) {
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
printf("%s\n", $solution); // 3892
