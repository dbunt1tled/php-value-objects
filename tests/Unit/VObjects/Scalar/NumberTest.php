<?php

declare(strict_types=1);

namespace DBUnt1tled\Test\Unit\VObjects\Scalar;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;

final class NumberTest extends MyCase
{
    public function testBoolean(): void
    {
        $i12 = new \DBUnt1tled\VO\VObjects\Scalar\Number(12);
        $this->assertEquals(12, $i12->getValue());
        $f23p43 = new \DBUnt1tled\VO\VObjects\Scalar\Number(23.45);
        $this->assertEquals(23.45, $f23p43->getValue());
        $i23 = \DBUnt1tled\VO\VObjects\Scalar\Number::createFromString('23');
        $this->assertEquals(23, $i23->getValue());
        $i23 = \DBUnt1tled\VO\VObjects\Scalar\Number::createFromString('-23');
        $this->assertEquals(-23, $i23->getValue());
        $fNot15p13 = \DBUnt1tled\VO\VObjects\Scalar\Number::createFromString('-15.13');
        $this->assertEquals(-15.13, $fNot15p13->getValue());
    }
    public function testExcept(): void
    {
        $this->assertException(InvalidVOArgumentException::class, function () {
            new \DBUnt1tled\VO\VObjects\Scalar\Number('-15.13a');
        });
        $this->assertException(InvalidVOArgumentException::class, function () {
            \DBUnt1tled\VO\VObjects\Scalar\Number::createFromString('-15.13a');
        });
    }
}
