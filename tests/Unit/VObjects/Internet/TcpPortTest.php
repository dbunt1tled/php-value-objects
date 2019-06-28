<?php

declare(strict_types=1);

namespace DBUnt1tled\Test\Unit\VObjects\Internet;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Internet\TcpPort;
use DBUnt1tled\VO\VObjects\Scalar\Integer;

final class TcpPortTest extends MyCase
{
    /**
     * @throws \ReflectionException
     */
    public function testTcpPort(): void
    {
        $port1 = new TcpPort(new Integer(80));
        $this->assertEquals(80, $port1->getValue());

        $port2 = TcpPort::createFromString('755');
        $this->assertEquals(755, $port2->getValue());

        $port3 = TcpPort::createFromInt(2334);
        $this->assertEquals(2334, $port3->getValue());
    }

    public function testException(): void
    {
        $this->assertException(InvalidVOArgumentException::class, function () {
            TcpPort::createFromString('192a');
        });
        $this->assertException(InvalidVOArgumentException::class, function () {
            TcpPort::createFromInt(65536);
        });
        $this->assertException(InvalidVOArgumentException::class, function () {
            TcpPort::createFromInt(-1);
        });
    }
}
