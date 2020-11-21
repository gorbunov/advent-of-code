<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$oldPassword = 'vzbxkghb';
$incrementer = new \Passwords\PasswordIncrementer($oldPassword);
$newPassword = $incrementer->getNext();

while (!\Passwords\PasswordValidator::isValid($newPassword)) {
    $newPassword = $incrementer->getNext();
}

printf("New password: %s\n", $incrementer->getPassword());

$newPassword = $incrementer->getNext();
while (!\Passwords\PasswordValidator::isValid($newPassword)) {
    $newPassword = $incrementer->getNext();
}

printf("Next new password: %s\n", $incrementer->getPassword());
