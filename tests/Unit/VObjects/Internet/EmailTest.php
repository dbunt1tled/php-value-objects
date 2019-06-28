<?php

declare(strict_types=1);

namespace DBUnt1tled\Test\Unit\VObjects\Internet;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Internet\Email;
use DBUnt1tled\VO\VObjects\Scalar\Strings;

final class EmailTest extends MyCase
{
    public function testName(): void
    {
        $email1 = new Email(new Strings('admin@example.com'));
        $this->assertEquals('admin@example.com', $email1->getValue());

        $email2 = Email::createFromString('moderator@example.com');
        $this->assertEquals('moderator@example.com', $email2->getValue());
        $this->assertEquals('moderator', $email2->userName());
        $this->assertEquals('example.com', $email2->domain());/**/
    }

    public function testException(): void
    {
        $this->assertException(InvalidVOArgumentException::class, function () {
            Email::createFromString('m@.c');
        });
    }
}
