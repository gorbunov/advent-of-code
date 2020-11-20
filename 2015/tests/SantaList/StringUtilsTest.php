<?php

declare(strict_types=1);

namespace SantaList;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertTrue;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotEquals;

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

    public function testhasForbiddenLetters()
    {
        assertTrue(StringUtils::hasForbiddenSubstrings('asdadbcvxbfasafsrarar', ['ar', 'bb']));
        assertFalse(StringUtils::hasForbiddenSubstrings('asdadbcvxbfasafsrarar', ['dd', 'bb']));
    }

    public function testHasPairedSeparatedLetters()
    {
        assertTrue(StringUtils::hasPairedLettersSeparatedByLetter('ieodomkazucvgmuy'));
        assertFalse(StringUtils::hasPairedLettersSeparatedByLetter('uurcxstgmygtbstg'));
    }

    public function testPairedLetters()
    {
        assertEquals(['ra', 'aa', 'ad'], StringUtils::getPairedLetters('raragaadfereaadaadd'));
        assertNotEquals(['aa', 'dd'], StringUtils::getPairedLetters('raragadfereadadd'));
        assertEquals(['qj'], StringUtils::getPairedLetters('qjhvhtzxzqqjkmpb'));
        assertEquals(['xx'], StringUtils::getPairedLetters('xxyxx'));
        assertEquals(['st', 'tg'], StringUtils::getPairedLetters('uurcxstgmygtbstg'));
    }

    public function testCountPairs()
    {
        assertEquals(2, StringUtils::countPairs('aa', 'qorwqrqrqrquraarqrlqaaarqwroqrq'));
        assertEquals(2, StringUtils::countPairs('aa', 'qorwqrqrqrquraarqrlqaarqwroqrq'));
        assertEquals(1, StringUtils::countPairs('aa', 'qoradawqrqrqrqurabbarqrlqaarqwroqrq'));
        assertEquals(4, StringUtils::countPairs('xy', 'xyxyxyxy'));
    }
}
