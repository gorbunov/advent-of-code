<?php

declare(strict_types=1);

namespace SantaList;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class StringEvalTest extends TestCase
{
    public function unparsedStringsProvider()
    {
        return [
            ['"abc"', 'abc'],
            ['"aaa\"aaa"', 'aaa"aaa'],
            ['""', ''],
            ['"\x27"', "'"],
        ];
    }

    /**
     * @dataProvider unparsedStringsProvider
     *
     * @param $expected
     * @param $string
     */
    public function testParse($string, $expected)
    {
        assertEquals($expected, StringEval::parse($string));
    }
}
