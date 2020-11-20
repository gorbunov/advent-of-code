<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$santaList = file('./santalist.txt', FILE_IGNORE_NEW_LINES);

$validator = \SantaList\NicenessValidator::create();
$nice = 0;
foreach ($santaList as $line) {
    if ($validator->isNice($line)) {
        $nice++;
    }
}

printf("Found nice in list: %d\n", $nice);
