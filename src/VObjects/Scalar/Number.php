<?php

declare(strict_types=1);

namespace DBUnt1tled\VO\VObjects\Scalar;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\ValueObject;

class Number extends ValueObject
{
    /**
     * @param mixed $value
     * @param mixed ...$other
     * @throws \ReflectionException
     */
    public function guard($value, ...$other): void
    {
        parent::guard($value);
        if (!is_numeric($value) || is_bool($value)) {
            throw new InvalidVOArgumentException('Value is invalid. Allowed type is integer, float, double, real', $value);
        }
    }

    /**
     * @param string $string
     * @return Number
     * @throws \ReflectionException
     */
    public static function createFromString(string $string): self
    {
        if (filter_var($string, FILTER_VALIDATE_INT) !== false) {
            return new static((int)$string);
        }
        if (is_numeric($string)) {
            return new static((float)$string);
        }
        throw new InvalidVOArgumentException('Value is invalid. Allowed type is integer, float, double, real', $string);
    }
}
