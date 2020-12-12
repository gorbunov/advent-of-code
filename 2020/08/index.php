<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

use Decoding\Decoder;

$data = file('./datastream.txt', FILE_IGNORE_NEW_LINES);
//$data = file('./datastream-example.txt', FILE_IGNORE_NEW_LINES);

$stream = array_map('\intval', $data);

$codes = Decoder::prepare($stream, 25);

$sequenceBreaker = $codes->findSequenceBreak();
printf("Sequence breaks at: %d\n", $sequenceBreaker);
printf("Sequence decoding edges sum: %d\n", $codes->sumMinMaxSequence(...array_keys($codes->sequenceWalk($sequenceBreaker))));
# var_dump($codes->sequenceWalk($sequenceBreaker));
