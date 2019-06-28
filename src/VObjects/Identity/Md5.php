<?php

declare(strict_types=1);

namespace DBUnt1tled\VO\VObjects\Identity;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Scalar\Strings;
use DBUnt1tled\VO\VObjects\ValueObjectComplex;
use DBUnt1tled\VO\VObjects\ValueObjectInterface;

class Md5 extends ValueObjectComplex
{

    /**
     * @param mixed $value
     * @param mixed ...$other
     * @throws \ReflectionException
     */
    public function guard($value, ...$other): void
    {
        parent::guard($value);
        /** @var ValueObjectInterface $value*/
        if (false === (bool)preg_match('/^[a-f0-9]{32}$/', $value->getValue())) {
            throw new InvalidVOArgumentException('Value is not a valid md5 hash.', $value);
        }
    }

    /**
     * @param string $value
     * @return Md5
     * @throws \ReflectionException
     */
    public static function createFromString(string $value): self
    {
        return new static(new Strings($value));
    }

    /**
     * @param string $value
     * @return Md5
     * @throws \ReflectionException
     */
    public static function generateFromValue(string $value): self
    {
        return new static(new Strings(md5($value)));
    }
}
