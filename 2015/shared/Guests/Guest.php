<?php declare(strict_types=1);


namespace Guests;


final class Guest
{
    private string $name;
    private array $relations = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function create(string $name)
    {
        return new self($name);
    }

    public function addRelation(string $to, Relation $relation)
    {
        $this->relations[$to] = $relation;
    }

    public function getRelationTo(string $to): Relation
    {
        return $this->relations[$to];
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


}
