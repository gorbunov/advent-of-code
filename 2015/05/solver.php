<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$santaList = file('./santalist.txt', FILE_IGNORE_NEW_LINES);

$ruleset1 = \SantaList\Ruleset01::getRules();
$ruleset2 = \SantaList\Ruleset02::getRules();

$validator1 = \SantaList\NicenessValidator::create($ruleset1);
$validator2 = \SantaList\NicenessValidator::create($ruleset2);
$nice1 = 0;
$nice2 = 0;
foreach ($santaList as $line) {
    if ($validator1->isNice($line)) {
        $nice1++;
    }
    if ($validator2->isNice($line)) {
        $nice2++;
    }
    // printf("%s: %b\n", $line, $validator2->isNice($line));
}

printf("Found nice in list (Ruleset1): %d\n", $nice1);
printf("Found nice in list (Ruleset2): %d\n", $nice2);
