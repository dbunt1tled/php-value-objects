<?php

declare(strict_types=1);

namespace DBUnt1tled\Test\Unit\VObjects\Internet;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Internet\Ip4Address;
use DBUnt1tled\VO\VObjects\Scalar\Strings;

final class Ip4AddressTest extends MyCase
{
    /**
     * @throws \ReflectionException
     */
    public function testIp4Address(): void
    {
        $ip1 = new Ip4Address(new Strings('127.0.0.1'));
        $this->assertEquals('127.0.0.1', $ip1->getValue());

        $ip2 = Ip4Address::createFromString('192.168.1.12');
        $this->assertEquals('192.168.1.12', $ip2->getValue());
    }

    public function testException(): void
    {
        $this->assertException(InvalidVOArgumentException::class, function () {
            Ip4Address::createFromString('192.168.112');
        });
        $this->assertException(InvalidVOArgumentException::class, function () {
            Ip4Address::createFromString('192.168.112.2.4');
        });
        $this->assertException(InvalidVOArgumentException::class, function () {
            Ip4Address::createFromString('2001:0db8:11a3:09d7:1f34:8a2e:07a0:765d');
        });
    }
}
