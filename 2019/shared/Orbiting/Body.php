<?php declare(strict_types=1);

namespace Orbiting;

class Body
{
    private const DEBUG = false;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Body[]
     */
    private $bodies = [];

    /**
     * @var Body|null
     */
    private $parent;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function create(string $name): self
    {
        return new self($name);
    }

    public function orbitedBy(Body $body): self
    {
        $this->bodies[$body->name()] = $body;
        return $this;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function orbitsAround(Body $body): self
    {
        $this->parent = $body;
        return $this;
    }

    public function parent(): ?Body
    {
        return $this->parent;
    }

    public function orbitsCount(int $depth): int
    {
        $count = $depth; // parent orbits count
        $depth++; // we are deeper
        foreach ($this->bodies as $body) { // child orbits
            $count += $body->orbitsCount($depth);
        }
        if (self::DEBUG) {
            print_array_values([$this->name, $depth, $count, $this->bodynames()]);
        }

        return $count;
    }

    private function bodynames(): string
    {
        $names = array_map(
            static function (Body $body) {
                return $body->name();
            },
            $this->bodies
        );
        return sprintf('[%s]', implode(', ', $names));
    }

    public function is(string $name): bool
    {
        return $this->name === $name;
    }

    public function __toString()
    {
        return $this->toString();
    }

    private function toString(): string
    {
        return sprintf('(%s)', $this->name);
    }
}
