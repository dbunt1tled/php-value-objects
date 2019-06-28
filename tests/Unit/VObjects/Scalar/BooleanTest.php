<?php

declare(strict_types=1);


namespace DBUnt1tled\Test\Unit\VObjects\Scalar;

use DBUnt1tled\Test\MyCase;

final class BooleanTest extends MyCase
{
    /**
     * @throws \ReflectionException
     */
    public function testBoolean(): void
    {
        $boolean = new \DBUnt1tled\VO\VObjects\Scalar\Boolean(true);
        $booleanInt = \DBUnt1tled\VO\VObjects\Scalar\Boolean::createFromInt(1);
        $booleanString1 = \DBUnt1tled\VO\VObjects\Scalar\Boolean::createFromString('1');
        $booleanString0 = \DBUnt1tled\VO\VObjects\Scalar\Boolean::createFromString('0');
        $booleanStringTrue = \DBUnt1tled\VO\VObjects\Scalar\Boolean::createFromString('True');
        $booleanStringFalse = \DBUnt1tled\VO\VObjects\Scalar\Boolean::createFromString('false');
        $this->assertTrue($boolean->getValue());
        $this->assertTrue($booleanInt->getValue());
        $this->assertTrue($booleanString1->getValue());
        $this->assertTrue($booleanString1->equals($booleanInt));
        $this->assertFalse($booleanInt->equals($booleanString0));
        $this->assertTrue($booleanStringTrue->getValue());
        $this->assertFalse($booleanStringFalse->getValue());
        $this->assertEquals(1, $booleanInt->toInt());
        $this->assertEquals(0, $booleanString0->toInt());
        $this->assertEquals('true', (string)$booleanInt);
        $this->assertEquals('false', (string)$booleanString0);
    }

    /**
     * @throws \ReflectionException
     */
    public function testLogic(): void
    {
        $bTrue = new \DBUnt1tled\VO\VObjects\Scalar\Boolean(true);
        $bFalse = new \DBUnt1tled\VO\VObjects\Scalar\Boolean(false);
        $bAnd = $bTrue->and($bTrue);
        $this->assertTrue($bAnd->getValue());
        $bAnd = $bTrue->or($bFalse);
        $this->assertTrue($bAnd->getValue());
        $bNot = $bTrue->not();
        $this->assertFalse($bNot->getValue());
        $bXor = $bTrue->xor($bTrue);
        $this->assertFalse($bXor->getValue());
    }
}
