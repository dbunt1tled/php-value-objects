<?php

declare(strict_types=1);

namespace DBUnt1tled\VO\VObjects\Scalar;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\ValueObject;

class Floats extends ValueObject
{
    /**
     * @param mixed $value
     * @param mixed ...$other
     * @throws \ReflectionException
     */
    public function guard($value, ...$other): void
    {
        parent::guard($value);
        if (!is_float($value) || !is_finite($value)) {
            throw new InvalidVOArgumentException('Value is invalid. Allowed type is float', $value);
        }
    }

    /**
     * @param int $int
     * @return Floats
     * @throws \ReflectionException
     */
    public static function createFromInt(int $int): self
    {
        return new static((float)$int);
    }

    /**
     * @param string $string
     * @return Floats
     * @throws \ReflectionException
     */
    public static function createFromString(string $string): self
    {
        return new static((float)$string);
    }
}
