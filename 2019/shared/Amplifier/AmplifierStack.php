<?php declare(strict_types=1);

namespace Amplifier;

final class AmplifierStack
{
    private $memory;

    private function __construct(string $memory)
    {
        $this->memory = $memory;
    }

    public static function create(string $program): self
    {
        return new self($program);
    }

    /**
     * @param int[] $phases
     *
     * @return int
     */
    public function run(array $phases): int
    {
        $signal = 0;
        foreach ($phases as $phase) {
            $signal = Amplifier::create($this->memory, $phase, $signal)->run();
        }
        return $signal;
    }

    public function permutations(array $elements)
    {
        if (count($elements) <= 1) {
            yield $elements;
        } else {
            foreach ($this->permutations(array_slice($elements, 1)) as $permutation) {
                foreach (range(0, count($elements) - 1) as $i) {
                    yield array_merge(
                        array_slice($permutation, 0, $i),
                        [$elements[0]],
                        array_slice($permutation, $i)
                    );
                }
            }
        }
    }
}
