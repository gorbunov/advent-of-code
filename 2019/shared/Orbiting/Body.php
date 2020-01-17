<?php declare(strict_types=1);

namespace Orbiting;

class Body
{
    /**
     * @var string
     */
    private $name;

    private $bodies = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function create(string $name): self
    {
        return new self($name);
    }

    public static function createCOM(): self
    {
        return new self('COM');
    }

    public function orbitedBy(Body $body)
    {
        $this->bodies[$body->name()] = $body;
    }

    public function name(): string
    {
        return $this->name;
    }
}
