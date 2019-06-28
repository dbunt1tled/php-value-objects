<?php

declare(strict_types=1);

namespace DBUnt1tled\Test\Unit\VObjects\Scalar;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;

final class IntegerTest extends MyCase
{
    public function testBoolean(): void
    {
        $i12 = new \DBUnt1tled\VO\VObjects\Scalar\Integer(12);
        $i23 = \DBUnt1tled\VO\VObjects\Scalar\Integer::createFromString('23');
        $iNot15 = \DBUnt1tled\VO\VObjects\Scalar\Integer::createFromString('-15');
        $i1 = \DBUnt1tled\VO\VObjects\Scalar\Integer::createFromBool(true);
        $i0 = \DBUnt1tled\VO\VObjects\Scalar\Integer::createFromBool(false);
        $this->assertEquals(1, $i1->getValue());
        $this->assertEquals(0, $i0->getValue());
        $this->assertEquals(-15, $iNot15->getValue());
        $this->assertEquals(23, $i23->getValue());
        $this->assertEquals(12, $i12->getValue());
    }

    public function testExcept(): void
    {
        $this->assertException(InvalidVOArgumentException::class, function () {
            new \DBUnt1tled\VO\VObjects\Scalar\Integer('1');
        });
        $this->assertException(InvalidVOArgumentException::class, function () {
            \DBUnt1tled\VO\VObjects\Scalar\Integer::createFromString('12a');
        });
    }
}
