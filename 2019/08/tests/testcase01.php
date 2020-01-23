<?php declare(strict_types=1);
require_once __DIR__.'/../../shared/autoload.php';

$image = \Image\SIFImage::create(3, 2, '123456789012');
$crc = $image->getLayersDigitsCount();
