<?php declare(strict_types=1);

namespace Keypad;

final class KeyCoder
{
    /**
     * @var Keypad
     */
    private Keypad $keypad;

    private $code = [];

    public function __construct(Keypad $keypad)
    {
        $this->keypad = $keypad;
    }

    public static function create(Keypad $keypad)
    {
        return new self($keypad);
    }

    public function guessDigit(string $instructions)
    {
        foreach (str_split($instructions) as $direction) {
            $this->moveToKeypadButton($direction);
        }
        $this->code[] = $this->keypad->getKeyNum();
    }

    private function moveToKeypadButton(string $direction)
    {
        switch ($direction) {
            case 'U':
                $this->keypad->moveUp();
                break;
            case 'D':
                $this->keypad->moveDown();
                break;
            case 'L':
                $this->keypad->moveLeft();
                break;
            case 'R':
                $this->keypad->moveRight();
                break;
        }
    }

    public function guessCode(array $instructions)
    {
        foreach ($instructions as $instruction) {
            $this->guessDigit($instruction);
        }

        return implode('', $this->code);
    }
}
