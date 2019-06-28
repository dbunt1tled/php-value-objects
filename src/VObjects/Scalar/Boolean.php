<?php

declare(strict_types=1);


namespace DBUnt1tled\VO\VObjects\Scalar;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\ValueObject;

class Boolean extends ValueObject
{
    /**
     * @param mixed $value
     * @param mixed ...$other
     * @throws \ReflectionException
     */
    public function guard($value, ...$other): void
    {
        parent::guard($value);
        if (!\is_bool($value)) {
            throw new InvalidVOArgumentException('Value is invalid. Allowed type is boolean', $value);
        }
    }

    /**
     * @param int $int
     * @return Boolean
     * @throws \ReflectionException
     */
    public static function createFromInt(int $int): self
    {
        return new static($int !== 0);
    }

    /**
     * @param string $string
     * @return Boolean
     * @throws \ReflectionException
     */
    public static function createFromString(string $string): self
    {
        return new static(mb_strtolower($string) === 'true' || $string === '1');
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value ? 'true' : 'false';
    }

    /**
     * @return int
     */
    public function toInt(): int
    {
        return $this->value ? 1 : 0;
    }

    /**
     * @param self $boolean
     * @return Boolean
     * @throws \ReflectionException
     */
    public function and(self $boolean): self
    {
        $andResult = $this->value && $boolean->value;
        return new static($andResult);
    }

    /**
     * @param self $boolean
     * @return Boolean
     * @throws \ReflectionException
     */
    public function or(self $boolean): self
    {
        $orResult = $this->value || $boolean->value;
        return new static($orResult);
    }

    /**
     * @return Boolean
     * @throws \ReflectionException
     */
    public function not(): self
    {
        $notResult = !$this->value;
        return new static($notResult);
    }

    /**
     * @param self $boolean
     * @return Boolean
     * @throws \ReflectionException
     */
    public function xor(self $boolean): self
    {
        $xorResult = ($this->value xor $boolean->value);
        return new static($xorResult);
    }
}
