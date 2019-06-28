<?php

declare(strict_types=1);

namespace DBUnt1tled\Test\Unit\VObjects\Internet;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Internet\Ip6Address;
use DBUnt1tled\VO\VObjects\Scalar\Strings;

final class Ip6AddressTest extends MyCase
{
    public function testName(): void
    {
        $ip1 = new Ip6Address(new Strings('2001:0db8:11a3:09d7:1f34:8a2e:07a0:765d'));
        $this->assertEquals('2001:0db8:11a3:09d7:1f34:8a2e:07a0:765d', $ip1->getValue());

        $ip2 = Ip6Address::createFromString('::ffff:192.0.2.1');
        $this->assertEquals('::ffff:192.0.2.1', $ip2->getValue());
        $ip2 = Ip6Address::createFromString('2001:4860:4860::8888');
        $this->assertEquals('2001:4860:4860::8888', $ip2->getValue());
    }

    public function testException(): void
    {
        $this->assertException(InvalidVOArgumentException::class, function () {
            Ip6Address::createFromString('192.168.112');
        });
        $this->assertException(InvalidVOArgumentException::class, function () {
            Ip6Address::createFromString('192.168.112.2.4');
        });
        $this->assertException(InvalidVOArgumentException::class, function () {
            Ip6Address::createFromString('2001:0db8:11a3:09d7:1f34:8a2e:07a0:76sd');
        });
    }
}
