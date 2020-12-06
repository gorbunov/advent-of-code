<?php declare(strict_types=1);

namespace Documents;

final class Passport
{
    /** @var PassportProperty[] */
    private array $properties;

    /**
     * Passport constructor.
     *
     * @param PassportProperty[] $properties
     */
    private function __construct(array $properties)
    {
        foreach ($properties as $property) {
            $this->properties[$property->getName()] = $property;
        }
    }

    public static function parse(string $record)
    {
        $record = str_replace("\n", " ", trim($record));
        $records = explode(" ", trim($record));

        $records = array_map(
            static function ($property) {
                [$name, $value] = explode(":", $property);
                return new PassportProperty($name, $value);
            },
            $records
        );

        return new self($records);
    }

    /**
     * @return PassportProperty[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    public function getPropertyNames(): array
    {
        return array_map(
            static function (PassportProperty $property) {
                return $property->getName();
            },
            $this->properties
        );
    }

    public function hasProperty(string $name): bool
    {
        return isset($this->properties[$name]);
    }

    public function getProperty(string $name): PassportProperty
    {
        return $this->properties[$name];
    }
}
