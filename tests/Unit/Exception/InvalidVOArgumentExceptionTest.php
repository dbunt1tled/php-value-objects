<?php

declare(strict_types=1);


namespace DBUnt1tled\Test\Unit\VObjects\Scalar;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Scalar\Boolean;

final class InvalidVOArgumentExceptionTest extends MyCase
{
    public function testException(): void
    {
        $ex = new InvalidVOArgumentException('Test Exception', ['test' => 'test']);
        $this->assertContains('Debug Info:', $ex->__toString());

        $this->assertException(InvalidVOArgumentException::class, function () {
            new Boolean('ex');
        });

        $this->assertException(InvalidVOArgumentException::class, function () {
            new InvalidVOArgumentException();
        });
    }
}
