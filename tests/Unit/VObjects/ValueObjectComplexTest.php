<?php

declare(strict_types=1);


namespace DBUnt1tled\VO\VObjects;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;

class ValueObjectComplexTest extends MyCase
{
    /**
     * @throws \ReflectionException
     */
    public function testStubString(): void
    {
        /** @var ValueObject $stub1 */
        $stub1 = $this->getMockForAbstractClass(ValueObject::class, ['test']);
        /** @var ValueObjectComplex $stub2 */
        $stub2 = $this->getMockForAbstractClass(ValueObjectComplex::class, [$stub1]);
        $this->assertEquals('test', $stub2->getValue());
        $this->assertEquals('test', $stub2->__toString());
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
        /** @var ValueObjectComplex $stub2 */
        $stub2 = $this->getMockForAbstractClass(ValueObjectComplex::class, [$stub1]);
        $this->assertEquals($obj, $stub2->getValue());
        $this->assertEquals(json_encode($obj), $stub2->__toString());
    }

    public function testException(): void
    {
        $this->assertException(InvalidVOArgumentException::class, function () {
            $obj = new \stdClass();
            $obj->a = 5;
            /** @var ValueObjectComplex $stub */
            $this->getMockForAbstractClass(ValueObjectComplex::class, [$obj]);
        });
    }
}
