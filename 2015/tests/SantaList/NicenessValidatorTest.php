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
     * @param $line
     * @param $isExpectedTobeNice
     */
    public function testIsNice($line, $isExpectedTobeNice)
    {
        $validator = NicenessValidator::create();
        self::assertEquals($isExpectedTobeNice, $validator->isNice($line));
    }
}
