<?php

declare(strict_types=1);


namespace DBUnt1tled\VO\VObjects;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Scalar\Integer;

class ValueObjectTest extends MyCase
{
    /**
     * @throws \ReflectionException
     */
    public function testStubString(): void
    {
        /** @var ValueObject $stub */
        $stub = $this->getMockForAbstractClass(ValueObject::class, ['test']);
        $this->assertEquals('test', $stub->getValue());
        $this->assertEquals('test', $stub->__toString());
    }

    /**
     * @throws \ReflectionException
     */
    public function testStubObj(): void
    {
        $obj = new \stdClass();
        $obj->a = 5;
        /** @var ValueObject $stub1 */
        $stub1 = $this->getMockForAbstractClass(ValueObject::class, [$obj]);
        /** @var ValueObject $stub2 */
        $stub2 = $this->getMockForAbstractClass(ValueObject::class, [$obj]);
        $this->assertTrue($stub1->equals($stub2));
        $this->assertEquals(json_encode($obj), $stub1->__toString());
    }

    /**
     * @throws \ReflectionException
     */
    public function testException(): void
    {
        $obj = new \stdClass();
        $obj->a = 5;
        $this->assertException(InvalidVOArgumentException::class, function () {
            /** @var ValueObject $stub1 */
            $this->getMockForAbstractClass(ValueObject::class, [null]);
        });

        /** @var ValueObject $stub2 */
        $stub2 = $this->getMockForAbstractClass(ValueObject::class, [$obj]);
        $int = new Integer(1);
        $this->assertException(InvalidVOArgumentException::class, function () use ($stub2, $int) {
            $stub2->equals($int);
        });
    }
}
