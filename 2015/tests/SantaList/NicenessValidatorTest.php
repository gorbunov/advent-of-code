<?php

declare(strict_types=1);

namespace SantaList;

use PHPUnit\Framework\TestCase;

final class NicenessValidatorTest extends TestCase
{

    public function santaListRuleset1Provider(): array
    {
        return [
            ['ugknbfddgicrmopn', true],
            ['aaa', true],
            ['jchzalrnumimnmhp', false],
            ['haegwjzuvuyypxyu', false],
            ['dvszwmarrgswjxmb', false],
        ];
    }

    public function santaListRuleset2Provider(): array
    {
        return [
            ['qjhvhtzxzqqjkmpb', true],
            ['xxyxx', true],
            ['uurcxstgmygtbstg', false],
            ['ieodomkazucvgmuy', false],
        ];
    }

    /**
     * @dataProvider santaListRuleset1Provider
     *
     * @param $line
     * @param $isExpectedTobeNice
     */
    public function testIsNiceByRuleset1($line, $isExpectedTobeNice)
    {
        $validator = NicenessValidator::create(Ruleset01::getRules());
        self::assertEquals($isExpectedTobeNice, $validator->isNice($line));
    }

    /**
     * @dataProvider santaListRuleset2Provider
     *
     * @param $line
     * @param $isExpectedTobeNice
     */
    public function testIsNiceByRuleset2($line, $isExpectedTobeNice)
    {
        $validator = NicenessValidator::create(Ruleset02::getRules());
        self::assertEquals($isExpectedTobeNice, $validator->isNice($line));
    }
}
