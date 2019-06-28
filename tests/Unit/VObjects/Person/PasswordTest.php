<?php

declare(strict_types=1);

namespace DBUnt1tled\Test\Unit\VObjects\Scalar;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Person\Password;
use DBUnt1tled\VO\VObjects\Scalar\Strings;

final class PasswordTest extends MyCase
{
    /**
     * @throws \ReflectionException
     */
    public function testPassword(): void
    {
        $password1 = new Password(new Strings('1J#ohn2f3G7'));
        $this->assertEquals('1J#ohn2f3G7', $password1->getValue());
        $password2 = Password::createFromString('1%n2fsd%#D3G7');
        $this->assertEquals('1%n2fsd%#D3G7', $password2->getValue());
    }

    public function testException(): void
    {
        // Low Symbols
        $this->assertException(InvalidVOArgumentException::class, function () {
            Password::createFromString('1%n2fsD');
        });
        // High Symbols
        $this->assertException(InvalidVOArgumentException::class, function () {
            Password::createFromString('1%n2fsd111D1111111111111111111');
        });
        // Only digits
        $this->assertException(InvalidVOArgumentException::class, function () {
            Password::createFromString('12345678');
        });
        // Only digits symbols
        $this->assertException(InvalidVOArgumentException::class, function () {
            Password::createFromString('1a2345678');
        });
        //  Without spec symbols
        $this->assertException(InvalidVOArgumentException::class, function () {
            Password::createFromString('1aG2345678');
        });
        // Without CAPS Letters
        $this->assertException(InvalidVOArgumentException::class, function () {
            Password::createFromString('1a$2345678');
        });
        // Without digits
        $this->assertException(InvalidVOArgumentException::class, function () {
            Password::createFromString('aaaAD#xcvD');
        });
    }
}
