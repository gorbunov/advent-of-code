<?php declare(strict_types=1);

namespace Cookies;

final class Ingredient
{
    private string $name;
    private int $capacity;
    private int $durability;
    private int $flavor;
    private int $texture;
    private int $calories;

    public function __construct(string $name, int $capacity, int $durability, int $flavor, int $texture, int $calories)
    {
        $this->name = $name;
        $this->capacity = $capacity;
        $this->durability = $durability;
        $this->flavor = $flavor;
        $this->texture = $texture;
        $this->calories = $calories;
    }

    public static function parse(string $line): self
    {
        preg_match("~^(?'name'\w+): capacity (?'capacity'-?\d+), durability (?'durability'-?\d+), flavor (?'flavor'-?\d+), texture (?'texture'-?\d+), calories (?'calories'-?\d+)$~", $line, $matches);
        return new self(
            $matches['name'],
            (int)$matches['capacity'],
            (int)$matches['durability'],
            (int)$matches['flavor'],
            (int)$matches['texture'],
            (int)$matches['calories']
        );
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getCapacity(): int
    {
        return $this->capacity;
    }

    /**
     * @return int
     */
    public function getDurability(): int
    {
        return $this->durability;
    }

    /**
     * @return int
     */
    public function getFlavor(): int
    {
        return $this->flavor;
    }

    /**
     * @return int
     */
    public function getTexture(): int
    {
        return $this->texture;
    }

    /**
     * @return int
     */
    public function getCalories(): int
    {
        return $this->calories;
    }


}
