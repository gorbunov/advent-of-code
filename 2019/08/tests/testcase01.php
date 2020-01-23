<?php declare(strict_types=1);
require_once __DIR__.'/../../shared/autoload.php';

$image = \Image\SIFImage::create(2, 2, '0222112222120000');

print_image_preview($image->decode());
