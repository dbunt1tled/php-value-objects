<?php

declare(strict_types=1);

namespace DBUnt1tled\VO\VObjects\Internet;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Scalar\Strings;
use DBUnt1tled\VO\VObjects\ValueObjectComplex;
use DBUnt1tled\VO\VObjects\ValueObjectInterface;

class Ip6Address extends ValueObjectComplex
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
        if (filter_var($value->getValue(), FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
            throw new InvalidVOArgumentException('Value is not a valid ip6 address.', $value);
        }
    }

    /**
     * @param string $value
     * @return Ip6Address
     * @throws \ReflectionException
     */
    public static function createFromString(string $value): self
    {
        return new static(new Strings($value));
    }
}
