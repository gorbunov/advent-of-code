<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

#$doclist = file_get_contents('./documents-example.txt');
$doclist = file_get_contents('./documents.txt');
#$doclist = file_get_contents('./valid-documents.txt');
#$doclist = file_get_contents('./invalid-documents.txt');

$passports = explode("\n\n", $doclist);
/** @var \Documents\Passport[] $passports */
$passports = array_map([\Documents\Passport::class, 'parse'], $passports);

$validation = array_map([\Documents\PassportValidator::class, 'validate'], $passports);
$valid = array_filter($validation, fn($validity) => $validity === true);

printf("Total valid passports: %d\n", count($valid));
