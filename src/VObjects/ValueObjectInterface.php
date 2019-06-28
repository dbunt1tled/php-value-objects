<?php
declare(strict_types=1);

namespace DBUnt1tled\VO\VObjects;

interface ValueObjectInterface
{
    /**
     * @return string
     */
    public function __toString(): string;

    /**
     * @param ValueObjectInterface $other
     * @return bool
     */
    public function equals(ValueObjectInterface $other):bool;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param mixed $value
     * @param mixed ...$other
     */
    public function guard($value, ...$other): void;
}
