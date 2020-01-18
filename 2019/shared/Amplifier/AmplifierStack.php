<?php declare(strict_types=1);

namespace Amplifier;

use Generator;
use IntCode\Program\InputFactory;
use IntCode\Program\OutputFactory;

use function count;
use function array_slice;

final class AmplifierStack
{
    private $memory;
    /**
     * @var Amplifier[]
     */
    private $amplifiers;

    private function __construct(string $memory, array $amps)
    {
        $this->memory = $memory;
        $this->amplifiers = $amps;
    }

    public static function createLine(string $program): self
    {
        $amplifiers = [];
        for ($ampId = 0; $ampId < 5; $ampId++) {
            $amplifiers[] = Amplifier::create($program, InputFactory::empty(), OutputFactory::create());
        }
        return new self($program, $amplifiers);
    }

    /**
     * @param int[] $phases
     *
     * @return self
     */
    private function configure(array $phases): AmplifierStack
    {
        $ampId = 0;
        foreach ($phases as $phase) {
            $amp = $this->amplifier($ampId++);
            $amp->configure($phase);
        }
        return $this;
    }

    private function amplifier(int $id): Amplifier
    {
        return $this->amplifiers[$id];
    }

    /**
     * @param int[] $phases
     *
     * @return int
     */
    public function run(array $phases): int
    {
        $this->configure($phases);
        $signal = 0;
        foreach ($this->amplifiers as $amplifier) {
            $amplifier->run($signal);
            $signal = $amplifier->output()->pop();
        }
        return $signal;
    }

    public function permutations(array $elements): ?Generator
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
