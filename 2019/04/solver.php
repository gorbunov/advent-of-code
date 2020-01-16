<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
$validator = \Validator\Validator::create(
    [
        \Validator\Rules\Range::create(254032, 789860),
    ]
);
