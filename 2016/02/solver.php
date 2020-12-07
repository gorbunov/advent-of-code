<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$instructions = file('./buttons.txt', FILE_IGNORE_NEW_LINES);
#$instructions = file('./buttons-examples.txt', FILE_IGNORE_NEW_LINES);

$ccoder = \Keypad\KeyCoder::create(\Keypad\MiniKeypad::create());

$code = $ccoder->guessCode($instructions);

printf("Bathroom code is: %s\n", $code);

$ccoder = \Keypad\KeyCoder::create(\Keypad\DiamondKeypad::create());

$code = $ccoder->guessCode($instructions);

printf("Real bathroom code is: %s\n", $code);
