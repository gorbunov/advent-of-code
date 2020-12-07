<?php


namespace Keypad;


interface Keypad
{
    public function getKeyNum(): string;
    public function moveUp();
    public function moveDown();
    public function moveLeft();
    public function moveRight();
}
