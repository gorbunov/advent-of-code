<?php declare(strict_types=1);

namespace Boarding;

final class BSearch
{
    public const TOP = 'top';
    public const BOTTOM = 'bottom';

    private array $ruleset;

    private function __construct(array $ruleset)
    {
        $this->ruleset = $ruleset;
    }

    public static function define(string $lower, string $upper): BSearch
    {
        return new self([self::TOP => $lower, self::BOTTOM => $upper]);
    }

    public function search(array $items, int $size, int $current): int
    {
        if ($size === 1) {
            return $current;
        }
        $subsize = (int)floor($size / 2);
        $index = $current;
        $action = array_shift($items);
        if ($action === $this->ruleset[self::BOTTOM]) {
            $index += $subsize;
        }
        // printf("Checking %s, (starts: %d\t size:%d), next: (%d - %d)\n", $action, $current, $size, $index, $subsize);
        return $this->search($items, $subsize, $index);
    }
}
