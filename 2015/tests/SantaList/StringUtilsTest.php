<?php

declare(strict_types=1);

namespace SantaList;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertEquals;

final class StringUtilsTest extends TestCase
{

    public function testSplit()
    {
        assertEquals(['a', 'b', 'c'], StringUtils::split('abc'));
    }

    public function testCountLetters()
    {
        assertEquals(['a' => 2, 'b' => 1, 'd' => 3], StringUtils::countLetters('aabddd'));
    }

    public function testVowelsCount()
    {
        assertEquals(8, StringUtils::getVowelsCount('aaeedbvabarui'));
    }

    public function pairedLettersStringProfider(): array
    {
        return [
            ['aabbccdd', true],
            ['asdfdgfghj', false],
            ['abcdde', true],
            ['xx', true],
            ['asdaxcvxvaa', true],
            ['vvwrwbnnbn', true],
            ['asdasdasda', false],
        ];
    }

    /**
     * @dataProvider pairedLettersStringProfider
     *
     * @param $string
     * @param $has
     */
    public function testHasPairedLetters($string, $has)
    {
        assertEquals($has, StringUtils::hasPairedLetters($string));
    }

    public function testhasForbiddenLetters(){
        assertTrue(StringUtils::hasForbiddenSubstrings('asdadbcvxbfasafsrarar', ['ar', 'bb']));
        assertFalse(StringUtils::hasForbiddenSubstrings('asdadbcvxbfasafsrarar', ['dd', 'bb']));
    }
}
