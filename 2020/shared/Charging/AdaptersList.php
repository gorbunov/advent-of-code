<?php declare(strict_types=1);

namespace Charging;

final class AdaptersList
{
    /** @var Adapter[] */
    private array $adapters;

    public static function parse(array $ratings): self
    {
        $adapters = array_map(fn($rating) => new Adapter($rating), $ratings);
        $max = max($ratings);
        $adapters[] = new Adapter($max + 3); // internal device adapter
        usort($adapters, fn(Adapter $adapter1, Adapter $adapter2) => $adapter1->getRating() <=> $adapter2->getRating());
        return new self($adapters);
    }

    public function __construct(array $adapters)
    {
        $this->adapters = $adapters;
        $deviceKey = array_key_last($adapters);
        $this->device = $adapters[$deviceKey] ?? null;
    }

    /**
     * @return mixed
     */
    public function getDevice(): ?Adapter
    {
        return $this->device;
    }


    /**
     * @param Adapter   $adapter
     * @param Adapter[] $adapters
     *
     * @return Adapter[]
     */
    public static function getNextAvailableAdapters(Adapter $adapter, array $adapters): array
    {
        return array_filter($adapters, fn(Adapter $matching) => $matching->canTake($adapter->getRating()));
    }

    public static function getNextAdapter(Adapter $adapter, array $adapters): ?Adapter
    {
        $suitable = self::getNextAvailableAdapters($adapter, $adapters);
        if (empty($suitable)) {
            return null;
        }
        return $suitable[array_key_first($suitable)];
    }

    /**
     * @param Adapter[] $usedAdapters
     * @param Adapter[] $allOfAdapters
     *
     * @return Adapter[]
     */
    public static function getAdapterListWithoutAdapters(array $usedAdapters, array $allOfAdapters): array
    {
        return array_filter($allOfAdapters, fn(Adapter $adapter) => !in_array($adapter, $usedAdapters));
    }

    public static function getAdapterListWithout(Adapter $adapter, array $adapters): array
    {
        return array_filter($adapters, fn(Adapter $matching) => $matching !== $adapter);
    }

    /**
     * @return Adapter[]
     */
    public function getAdapters(): array
    {
        return $this->adapters;
    }

    public function getRatings(): array
    {
        return array_map(fn(Adapter $adapter) => $adapter->getRating(), $this->adapters);
    }

    public function __toString()
    {
        return implode(', ', $this->getRatings());
    }


    /**
     * @param Adapter $adapter
     *
     * @return AdaptersList
     */
    public function without(Adapter $adapter): AdaptersList
    {
        return new AdaptersList(self::getAdapterListWithout($adapter, $this->adapters));
    }

    public function suitable(Adapter $adapter): AdaptersList
    {
        return new AdaptersList(self::getNextAvailableAdapters($adapter, $this->adapters));
    }

    public function isEmpty(): bool
    {
        return empty($this->adapters);
    }

    public function chains(Adapter $adapter, Adapter $device): int
    {
        if ($adapter === $device) { // connected
            return 1;
        }
        $rest = $this->without($adapter);
        //printf("%s\n", $rest);
        if ($rest->isEmpty()) // last adapter!
        {
            return 0;
        }
        $chainsTo = $rest->suitable($adapter);
        if ($chainsTo->isEmpty()) { // can't chain deeper!
            //printf("Empty: %s, => %s\n", $adapter->getRating(), $rest);
            return 0;
        }
        $found = 0;
        foreach ($chainsTo->getAdapters() as $next) {
            $found += $rest->chains($next, $device);
        }
        return $found;
    }

    public function next(Adapter $adapter)
    {
        $next = self::getNextAdapter($adapter, $this->adapters);
        if ($next === null) {
            return null;
        }
        $rest = new AdaptersList(self::getAdapterListWithout($next, $this->adapters));
        // printf("%s => %s\n", $next->getRating(), $rest);
        $chained = $rest->next($next);
        if (is_null($chained)) {
            return [$next];
        }
        if (!is_array($chained)) {
            return [$chained];
        }
        return array_merge([$next], $chained);
    }

    /**
     * @param Adapter[] $adapters
     *
     * @return int[]
     */
    public static function getJoltDiff(array $adapters): array
    {
        $diffs = [];
        for ($i = 1, $iMax = count($adapters); $i < $iMax; $i++) {
            $key = $adapters[$i]->getRating() - $adapters[$i - 1]->getRating();
            if (!array_key_exists($key, $diffs)) {
                $diffs[$key] = 0;
            }
            $diffs[$key]++;
        }
        return $diffs;
    }

    public function begin(Adapter $outlet): array
    {
        return array_merge([$outlet], $this->next($outlet));
    }
}
