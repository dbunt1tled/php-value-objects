<?php

declare(strict_types=1);


namespace DBUnt1tled\Test\Unit\VObjects\Scalar;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;

final class StringsTest extends MyCase
{
    public function testBoolean(): void
    {
        $string = '  Aaa  ';
        $s2spAaaa2sp = new \DBUnt1tled\VO\VObjects\Scalar\Strings($string);
        $sNot123f12 = \DBUnt1tled\VO\VObjects\Scalar\Strings::createFromFloat(-123.12);
        $this->assertEquals('-123.12', $sNot123f12->getValue());
        $sInt = \DBUnt1tled\VO\VObjects\Scalar\Strings::createFromInt(123);
        $this->assertEquals('123', $sInt->getValue());
        $this->assertEquals(mb_strlen($string), $s2spAaaa2sp->length());
        $sAaa = $s2spAaaa2sp->trim();
        $this->assertNotEquals($string, $sAaa->getValue());
        $this->assertEquals(3, $sAaa->length());

        $this->assertEquals('AAA', $sAaa->toUpperCase()->getValue());
        $this->assertEquals('aaa', $sAaa->toLowerCase()->getValue());
    }

    public function testIsEmpty():void
    {
        $string1 = new \DBUnt1tled\VO\VObjects\Scalar\Strings('  Aaa  ');
        $string2 = new \DBUnt1tled\VO\VObjects\Scalar\Strings('       ');
        $this->assertTrue($string2->trim()->isEmpty());
        $this->assertFalse($string1->trim()->isEmpty());
    }

    public function testExcept1(): void
    {
        $this->assertException(InvalidVOArgumentException::class, function () {
            new \DBUnt1tled\VO\VObjects\Scalar\Strings(1.00);
        });
    }
}
