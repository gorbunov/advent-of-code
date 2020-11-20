<?php

declare(strict_types=1);

namespace SantaList;

use PHPUnit\Framework\TestCase;

final class NicenessValidatorTest extends TestCase
{

    public function santaListProvider(): array
    {
        return [
            ['ugknbfddgicrmopn', true],
            ['aaa', true],
            ['jchzalrnumimnmhp', false],
            ['haegwjzuvuyypxyu', false],
            ['dvszwmarrgswjxmb', false],
        ];
    }

    /**
     * @dataProvider santaListProvider
     *
     * @param $line
     * @param $isExpectedTobeNice
     */
    public function testIsNiceByRuleset1($line, $isExpectedTobeNice)
    {
        $validator = NicenessValidator::create(Ruleset01::getRules());
        self::assertEquals($isExpectedTobeNice, $validator->isNice($line));
    }
}
