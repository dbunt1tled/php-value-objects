<?php

declare(strict_types=1);

namespace DBUnt1tled\Test\Unit\VObjects\Scalar;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Person\NameExtended;
use DBUnt1tled\VO\VObjects\Scalar\Strings;

final class NameExtendedTest extends MyCase
{
    /**
     * @throws \ReflectionException
     */
    public function testNameExtended(): void
    {
        $sJW = new NameExtended(new Strings('John'), new Strings('Wick'), new Strings('Wilson'));
        $this->assertEquals('John', $sJW->getFirstName());
        $this->assertEquals('Wilson', $sJW->getLastName());
        $this->assertEquals('Wick', $sJW->getMiddleName());
        $this->assertEquals('John Wick Wilson', $sJW->getValue());
        $this->assertEquals('John Wick Wilson', $sJW->__toString());
        $this->assertEquals('John Wick Wilson', $sJW->getFullName());

        $sMG = NameExtended::createFromString('Mina', 'Anderson', 'Good');
        $this->assertEquals('Mina Anderson Good', $sMG->getFullName());
        $this->assertEquals('Mina', $sMG->getFirstName());
        $this->assertEquals('Good', $sMG->getLastName());
        $this->assertEquals('Anderson', $sMG->getMiddleName());
    }

    public function testException(): void
    {
        $this->assertException(InvalidVOArgumentException::class, function () {
            NameExtended::createFromString('Min', 'Good', 'Anderson');
        });
        $this->assertException(InvalidVOArgumentException::class, function () {
            NameExtended::createFromString('Mina', 'Goo', 'Anderson');
        });
        $this->assertException(InvalidVOArgumentException::class, function () {
            NameExtended::createFromString('Mina', 'Good', 'And');
        });
    }
}
