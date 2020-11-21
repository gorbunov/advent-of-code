<?php

namespace Passwords;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class PasswordIncrementerTest extends TestCase
{

    public function iteratedPasswordsDataProvider()
    {
        return [
            ['xx', 'xy'],
            ['xxxxxxx', 'xxxxxxy'],
            ['xz', 'ya'],
        ];
    }

    /**
     *
     * @dataProvider iteratedPasswordsDataProvider
     *
     * @param $current
     * @param $next
     */
    public function testNext($current, $next)
    {
        assertEquals($next, PasswordIncrementer::next($current));
    }
}
