<?php declare(strict_types=1);

use IntCode\IntCodeComputer;
use IntCode\Program\InputFactory;

require_once __DIR__.'/../shared/autoload.php';

$inputs = [
    1 => 'Air conditioner diagnostics',
    5 => 'Thermal radiators',
];

$program = trim(file_get_contents('./program.txt'));

foreach ($inputs as $input => $system) {
    $input = InputFactory::create([$input]);

    $cpu = IntCodeComputer::load($program, $input);
    $output = $cpu->run()->output();
    printf("%s\n", $system);
    print_array_values($output->outputs());
}
