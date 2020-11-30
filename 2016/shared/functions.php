<?php declare(strict_types=1);
function xrange($min, $max)
{
    for ($i = $min; $i <= $max; $i++) {
        yield $i;
    }
}
