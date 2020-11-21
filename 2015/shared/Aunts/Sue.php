<?php declare(strict_types=1);

namespace Aunts;

final class Sue
{
    private string $name;
    private array $attributes;

    public function __construct(string $name, array $attributes)
    {
        $this->name = $name;
        $this->attributes = $attributes;
    }

    public static function parse(string $line): Sue
    {
        preg_match("~^Sue (?'number'\d+): (?'attributes'.*)\$~", $line, $matches);
        $name = 'Sue '.$matches['number'];
        preg_match_all("~(?'attr'\w+): (?'value'\d+)~", $matches['attributes'], $matches);
        $attributes = array_filter(
            $matches,
            static function ($value, $key) {
                return !is_numeric($key);
            },
            ARRAY_FILTER_USE_BOTH
        );
        $attributes = array_combine($attributes['attr'], $attributes['value']);
        $attributes = array_map('\intval', $attributes);
        return new Sue(
            $name, $attributes
        );
    }

    public function matches(array $attributes): bool
    {
        $correct = true;
        foreach ($this->attributes as $attribute => $value) {
            $correct = $correct && ($this->matchAttribute($attribute, $attributes[$attribute], $value));
        }
        return $correct;
    }

    private function matchAttribute(string $name, $descr, $aunts): bool
    {
        switch ($name) {
            case 'cats':
            case 'trees':
                return $aunts > $descr;
            case 'pomeranians':
            case 'goldfish':
                return $aunts < $descr;
        }
        return $aunts === $descr;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}
