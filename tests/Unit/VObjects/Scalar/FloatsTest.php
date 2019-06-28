<?php

declare(strict_types=1);


namespace DBUnt1tled\Test\Unit\VObjects\Scalar;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;

final class FloatsTest extends MyCase
{
    public function testFloat(): void
    {
        $float = new \DBUnt1tled\VO\VObjects\Scalar\Floats(0.02);
        $float1 = \DBUnt1tled\VO\VObjects\Scalar\Floats::createFromInt(1);
        $float2 = \DBUnt1tled\VO\VObjects\Scalar\Floats::createFromString('0.02');
        $float3 = new \DBUnt1tled\VO\VObjects\Scalar\Floats(1.2e3);
        $float4 = new \DBUnt1tled\VO\VObjects\Scalar\Floats(7E-10);
        $float5 = new \DBUnt1tled\VO\VObjects\Scalar\Floats(1.00);
        $this->assertIsFloat($float->getValue());
        $this->assertIsFloat($float1->getValue());
        $this->assertIsFloat($float2->getValue());
        $this->assertIsFloat($float3->getValue());
        $this->assertIsFloat($float4->getValue());
        $this->assertTrue($float2->equals($float));
        $this->assertFalse($float2->equals($float3));
        $this->assertTrue($float1->equals($float5));
    }

    /**
     * @throws \ReflectionException
     */
    public function testExcept1(): void
    {
        $float = new \DBUnt1tled\VO\VObjects\Scalar\Floats(1.00);
        try {
            $float->guard(5);
        } catch (InvalidVOArgumentException $ex) {
            $this->assertContains('Debug Info:', $ex->__toString());
        }
    }

    public function testExcept2(): void
    {
        $this->assertException(InvalidVOArgumentException::class, function () {
            new \DBUnt1tled\VO\VObjects\Scalar\Floats(1);
        });
    }
}
