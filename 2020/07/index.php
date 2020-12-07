<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$rules = file('./rules.txt', FILE_IGNORE_NEW_LINES);
//$rules = file('./rules-example.txt', FILE_IGNORE_NEW_LINES);

$luggage = \Luggage\Luggage::fill($rules);

$color = 'shiny gold';
printf("%d bags can contain %s\n", count($luggage->canContain($color, 1)), $color);
printf("%s bag will hold %d other bags\n", $color, $luggage->countNestedBags($color));
