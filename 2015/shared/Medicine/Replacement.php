<?php declare(strict_types=1);


namespace Medicine;


final class Replacement
{
    private string $name;
    private array $replacements = [];

    public static function create(string $name)
    {
        return new self($name);
    }

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addReplacement(string $replacement)
    {
        $this->replacements[] = $replacement;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getReplacements(): array
    {
        return $this->replacements;
    }


}
