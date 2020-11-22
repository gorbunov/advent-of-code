<?php declare(strict_types=1);


namespace Medicine;


final class MedsMachine
{
    /** @var array|Replacement[] */
    private array $replacements;
    private string $molecule;

    public function __construct(string $molecule)
    {
        $this->replacements = [];
        $this->molecule = $molecule;
    }

    public static function create(string $molecule)
    {
        return new self($molecule);
    }

    public function learnReplacement(string $name, string $replacement)
    {
        if (!isset($this->replacements[$name])) {
            $this->replacements[$name] = Replacement::create($name);
        }
        $this->replacements[$name]->addReplacement($replacement);
    }

    public function reduce(string $combination, $depth = 0)
    {
        printf("Depth: %d, combo: %s\n", $depth, $this->molecule);
        foreach ($this->getCombinations() as $combi) {
            if ($combi === 'e') {
                printf("Found at %d\n", $depth);
                die($depth);
            }
            $submachine = self::cloneForMolecule($combi, $this);
            $submachine->reduce($combi, $depth + 1);
        }
    }

    public function getCombinations()
    {
        $combinations = [];
        $replacements = [];
        foreach ($this->replacements as $src => $replacement) {
            foreach ($replacement->getReplacements() as $each) {
                printf("replacing %s => %s\n", $src, $each);
                $replacements[] = $this->replace($src, $each);
            }
        }
        foreach ($replacements as $found) {
            foreach ($found as $combination) {
                $combinations[] = $combination;
            }
        }
        return array_unique($combinations);
    }

    private function replace(string $what, string $withWhat): array
    {
        $replacements = [];
        $replacements_count = substr_count($this->molecule, $what);
        $nextPos = 0;
        for ($i = 0; $i < $replacements_count; $i++) {
            $nextPos = strpos($this->molecule, $what, $nextPos);
            $replacements[] = substr_replace($this->molecule, $withWhat, $nextPos, \strlen($what));
            $nextPos += \strlen($what);
            // printf("Replacing %s with %s, @%d\n", $what, $withWhat, $nextPos);
        }
        return $replacements;
    }

    public static function cloneForMolecule(string $molecule, MedsMachine $machine): MedsMachine
    {
        return (clone($machine))->setMolecule($molecule);
    }

    private function setMolecule(string $molecule): MedsMachine
    {
        $this->molecule = $molecule;
        return $this;
    }
}
