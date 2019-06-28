<?php

declare(strict_types=1);

namespace DBUnt1tled\Test\Unit\VObjects\Identity;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Identity\Uuid;
use DBUnt1tled\VO\VObjects\Scalar\Strings;

final class UuidTest extends MyCase
{
    public function testName(): void
    {
        $uuid1 = new Uuid(new Strings('bbc5637a-999e-11e9-a2a3-2a2ae2dbcce4'));
        $this->assertEquals('bbc5637a-999e-11e9-a2a3-2a2ae2dbcce4', $uuid1->getValue());
        $this->assertEquals(Uuid::UUID_V1, $uuid1->getVersion());

        $uuid2 = Uuid::createFromString('60eadfe2-a803-2ec1-a8d3-fd76e5719eb4');
        $this->assertEquals('60eadfe2-a803-2ec1-a8d3-fd76e5719eb4', $uuid2->getValue());
        $this->assertEquals(Uuid::UUID_V2, $uuid2->getVersion());

        $uuid3 = Uuid::createFromString('60eadfe2-a803-3ec1-a8d3-fd76e5719eb4');
        $this->assertEquals('60eadfe2-a803-3ec1-a8d3-fd76e5719eb4', $uuid3->getValue());
        $this->assertEquals(Uuid::UUID_V3, $uuid3->getVersion());

        $uuid4 = Uuid::createFromString('60eadfe2-a803-4ec1-a8d3-fd76e5719eb4');
        $this->assertEquals('60eadfe2-a803-4ec1-a8d3-fd76e5719eb4', $uuid4->getValue());
        $this->assertEquals(Uuid::UUID_V4, $uuid4->getVersion());

        $uuid5 = Uuid::createFromString('60eadfe2-a803-5ec1-a8d3-fd76e5719eb4');
        $this->assertEquals('60eadfe2-a803-5ec1-a8d3-fd76e5719eb4', $uuid5->getValue());
        $this->assertEquals(Uuid::UUID_V5, $uuid5->getVersion());

        $uuidNil = Uuid::createFromString('00000000-0000-0000-0000-000000000000');
        $this->assertEquals('00000000-0000-0000-0000-000000000000', $uuidNil->getValue());
        $this->assertEquals(Uuid::UUID_NIL, $uuidNil->getVersion());

        $uuidValid = Uuid::createFromString('60eadfe2-a803-7ec1-98d3-fd76e5719eb4');
        $this->assertEquals('60eadfe2-a803-7ec1-98d3-fd76e5719eb4', $uuidValid->getValue());
        $this->assertEquals(Uuid::UUID_VALID, $uuidValid->getVersion());

        $uuid1 = new Uuid(new Strings('bbc5637a-999e-11e9-a2a3-2a2ae2dbcce4'), Uuid::UUID_V1);
        $this->assertEquals('bbc5637a-999e-11e9-a2a3-2a2ae2dbcce4', $uuid1->getValue());
        $this->assertEquals(Uuid::UUID_V1, $uuid1->getVersion());

        $uuid2 = Uuid::createFromString('60eadfe2-a803-2ec1-a8d3-fd76e5719eb4', Uuid::UUID_V2);
        $this->assertEquals('60eadfe2-a803-2ec1-a8d3-fd76e5719eb4', $uuid2->getValue());
        $this->assertEquals(Uuid::UUID_V2, $uuid2->getVersion());

        $uuid3 = Uuid::createFromString('60eadfe2-a803-3ec1-a8d3-fd76e5719eb4', Uuid::UUID_V3);
        $this->assertEquals('60eadfe2-a803-3ec1-a8d3-fd76e5719eb4', $uuid3->getValue());
        $this->assertEquals(Uuid::UUID_V3, $uuid3->getVersion());

        $uuid4 = Uuid::createFromString('60eadfe2-a803-4ec1-a8d3-fd76e5719eb4', Uuid::UUID_V4);
        $this->assertEquals('60eadfe2-a803-4ec1-a8d3-fd76e5719eb4', $uuid4->getValue());
        $this->assertEquals(Uuid::UUID_V4, $uuid4->getVersion());

        $uuid5 = Uuid::createFromString('60eadfe2-a803-5ec1-a8d3-fd76e5719eb4', Uuid::UUID_V5);
        $this->assertEquals('60eadfe2-a803-5ec1-a8d3-fd76e5719eb4', $uuid5->getValue());
        $this->assertEquals(Uuid::UUID_V5, $uuid5->getVersion());

        $uuidNil = Uuid::createFromString('00000000-0000-0000-0000-000000000000', Uuid::UUID_NIL);
        $this->assertEquals('00000000-0000-0000-0000-000000000000', $uuidNil->getValue());
        $this->assertEquals(Uuid::UUID_NIL, $uuidNil->getVersion());

        $uuidValid = Uuid::createFromString('60eadfe2-a803-7ec1-98d3-fd76e5719eb4', Uuid::UUID_VALID);
        $this->assertEquals('60eadfe2-a803-7ec1-98d3-fd76e5719eb4', $uuidValid->getValue());
        $this->assertEquals(Uuid::UUID_VALID, $uuidValid->getVersion());
    }

    public function testException(): void
    {
        $this->assertException(InvalidVOArgumentException::class, function () {
            Uuid::createFromString('60eadfe2-a803-2ec1-a8d3-fd476e5719eb', Uuid::UUID_V1);
        });

        $this->assertException(InvalidVOArgumentException::class, function () {
            Uuid::createFromString('60eadfe2-a803-7ec1-98d3-fd76e719eb4');
        });

        $this->assertException(InvalidVOArgumentException::class, function () {
            Uuid::createFromString('60eadfe2-a803-5ec1-a8d3-fd76e5s19eb4');
        });
    }
}
