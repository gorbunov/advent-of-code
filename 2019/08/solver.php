<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
$image = trim(file_get_contents('./image.txt', false));

$image = \Image\SIFImage::create(25, 6, $image);

$info = $image->getLayersDigitsCount();
$min = 25 * 6; // max layer size
$found = [];
foreach ($info as $pos => $layer) {
    // less 0-es than other layer
    if ($layer[0] <= $min) {
        $min = $layer[0];
        $found = $layer;
    }
}

printf("Image Checksum: %d\n", $found[1] * $found[2]);

print_image_preview($image->decode());
