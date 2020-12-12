<?php declare(strict_types=1);

namespace Decoding;

use Math\Combinator;
use JetBrains\PhpStorm\Pure;

final class Decoder
{
    /** @var int[] */
    private array $datastream;
    private int $preambleSize;
    /** @var int[] */
    private array $currentStack;
    /** @var array int[] */
    private array $source;

    public static function prepare(array $datasteam, int $preambleSize): Decoder
    {
        return new self($datasteam, $preambleSize);
    }

    private function __construct(array $datastream, int $preambleSize)
    {
        $this->source = $datastream;
        $this->datastream = $datastream;
        $this->preambleSize = $preambleSize;
        $this->currentStack = array_splice($this->datastream, 0, $this->preambleSize);
    }

    private function getStackCombinations(): \Iterator
    {
        return Combinator::combinations($this->currentStack, 2);
    }

    private function getPairsSum(\Iterator $pairs): array
    {
        $result = [];
        foreach ($pairs as $pair) {
            $result[] = array_sum($pair);
        }
        return $result;
    }

    private function isValidNextItem(int $item): bool
    {
        return in_array($item, $this->getPairsSum($this->getStackCombinations()), true);
    }

    public function findSequenceBreak(): int
    {
        while (!empty($this->datastream)) {
            $next = array_shift($this->datastream);
            if (!$this->isValidNextItem($next)) {
                return $next;
            }
            array_shift($this->currentStack);
            $this->currentStack[] = $next;
        }
        return 0;
    }

    private function sequenceSum(int $startIndex, int $endIndex): int
    {
        return array_sum(array_slice($this->source, $startIndex, $endIndex - $startIndex + 1));
    }

    public function sequenceWalk(int $searchFor)
    {
        $startIndex = $endIndex = $sequenceSum = 0;
        while ($searchFor !== $sequenceSum) {
            $sequenceSum = $this->sequenceSum($startIndex, $endIndex);
            // printf("%d - %d = %d\n", $startIndex, $endIndex, $sequenceSum);
            if ($sequenceSum < $searchFor) {
                $endIndex++;
            } elseif ($sequenceSum > $searchFor) {
                $startIndex++;
            }
        }
        return [$startIndex => $this->source[$startIndex], $endIndex => $this->source[$endIndex]];
    }

    public function sumMinMaxSequence(int $startIndex, int $endIndex): int
    {
        $seq = array_slice($this->source, $startIndex, $endIndex - $startIndex + 1);
        $max = max($seq);
        $min = min($seq);
        return $max + $min;
    }
}
