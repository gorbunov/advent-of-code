<?php declare(strict_types=1);

namespace Amplifier;

use IntCode\Program\InputFactory;
use IntCode\Program\OutputFactory;

final class AmplifierStack
{
    private $memory;
    /**
     * @var Amplifier[]
     */
    private $amps;

    private function __construct(string $memory, array $amps)
    {
        $this->memory = $memory;
        $this->amps = $amps;
    }

    public static function createLine(string $program): self
    {
        $amplifiers = [];
        foreach (range(0, 5) as $ampId) {
            $amplifiers[$ampId] = Amplifier::create($program, InputFactory::empty(), OutputFactory::create());
        }
        return new self($program, $amplifiers);
    }


    /**
     * @param int[] $phases
     *
     * @return int
     */
    public function run(array $phases): int
    {
        $signal = 0;
        $ampId = 0;
        foreach ($phases as $phase) {
            $amp = $this->getAmp($ampId++);
            $amp->run($phase, $signal);
        }
        return $signal;
    }

    private function getAmp(int $id): Amplifier
    {
        return $this->amps[$id];
    }

    public function permutations(array $elements): ?\Generator
    {
        if (\count($elements) <= 1) {
            yield $elements;
        } else {
            foreach ($this->permutations(\array_slice($elements, 1)) as $permutation) {
                foreach (range(0, \count($elements) - 1) as $i) {
                    yield array_merge(
                        \array_slice($permutation, 0, $i),
                        [$elements[0]],
                        \array_slice($permutation, $i)
                    );
                }
            }
        }
    }

}
