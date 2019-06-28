<?php

declare(strict_types=1);

namespace DBUnt1tled\Test\Unit\VObjects\Scalar;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Person\Age;
use DBUnt1tled\VO\VObjects\Scalar\Integer;

final class AgeTest extends MyCase
{
    public function testAge(): void
    {
        $a12 = new Age(new Integer(12));
        $a24 = Age::createFromInt(24);
        $a32 = Age::createFromString('32');
        $this->assertEquals(12, $a12->getValue());
        $this->assertEquals(24, $a24->getValue());
        $this->assertEquals(32, $a32->getValue());
    }

    public function testException(): void
    {
        $this->assertException(InvalidVOArgumentException::class, function () {
            Age::createFromString('345');
        });
        $this->assertException(InvalidVOArgumentException::class, function () {
            Age::createFromString('0');
        });
        $this->assertException(InvalidVOArgumentException::class, function () {
            Age::createFromString('345a');
        });
        $this->assertException(InvalidVOArgumentException::class, function () {
            Age::createFromString('345');
        });
    }
}
