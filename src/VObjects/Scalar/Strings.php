<?php

declare(strict_types=1);


namespace DBUnt1tled\VO\VObjects\Scalar;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\ValueObject;

class Strings extends ValueObject
{
    /**
     * @param mixed $value
     * @param mixed ...$other
     * @throws \ReflectionException
     */
    public function guard($value, ...$other): void
    {
        parent::guard($value);
        if (!\is_string($value)) {
            throw new InvalidVOArgumentException('Value is invalid. Allowed type is string', $value);
        }
    }

    /**
     * @param int $int
     * @return Strings
     * @throws \ReflectionException
     */
    public static function createFromInt(int $int): self
    {
        return new static((string)$int);
    }

    /**
     * @param float $float
     * @return Strings
     * @throws \ReflectionException
     */
    public static function createFromFloat(float $float): self
    {
        return new static((string)$float);
    }

    /**
     * @return int
     */
    public function length(): int
    {
        return mb_strlen($this->value);
    }

    /**
     * @return Strings
     * @throws \ReflectionException
     */
    public function trim(): self
    {
        return new static(trim($this->value));
    }

    /**
     * @return Strings
     * @throws \ReflectionException
     */
    public function toUpperCase(): self
    {
        return new static(strtoupper($this->value));
    }

    /**
     * @return Strings
     * @throws \ReflectionException
     */
    public function toLowerCase(): self
    {
        return new static(strtolower($this->value));
    }

    /**
     * @return bool
     */
    public function isEmpty(): bool
    {
        return $this->value === '';
    }
}
