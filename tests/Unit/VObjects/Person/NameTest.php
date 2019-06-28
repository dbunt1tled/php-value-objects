<?php

declare(strict_types=1);

namespace DBUnt1tled\Test\Unit\VObjects\Scalar;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Person\Name;
use DBUnt1tled\VO\VObjects\Scalar\Strings;

final class NameTest extends MyCase
{
    /**
     * @throws \ReflectionException
     */
    public function testName(): void
    {
        $sJW = new Name(new Strings('John'), new Strings('Wick'));
        $this->assertEquals('John Wick', $sJW->getFullName());
        $this->assertEquals('John', $sJW->getFirstName());
        $this->assertEquals('Wick', $sJW->getLastName());
        $this->assertEquals('John Wick', $sJW->getValue());
        $this->assertEquals('John Wick', $sJW->__toString());

        $sMG = Name::createFromString('Mina', 'Good');
        $this->assertEquals('Mina Good', $sMG->getFullName());
        $this->assertEquals('Mina', $sMG->getFirstName());
        $this->assertEquals('Good', $sMG->getLastName());
    }

    public function testException(): void
    {
        $this->assertException(InvalidVOArgumentException::class, function () {
            Name::createFromString('Min', 'Good');
        });
        $this->assertException(InvalidVOArgumentException::class, function () {
            Name::createFromString('Mina', 'Goo');
        });
    }
}
