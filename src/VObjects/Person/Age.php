<?php

declare(strict_types=1);

namespace DBUnt1tled\VO\VObjects\Person;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Scalar\Integer;
use DBUnt1tled\VO\VObjects\ValueObjectComplex;
use DBUnt1tled\VO\VObjects\ValueObjectInterface;

class Age extends ValueObjectComplex
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
        $v = $value->getValue();
        if ($v < 1 || $v > 200) {
            throw new InvalidVOArgumentException('Value is not a valid age.', $value);
        }
    }

    /**
     * @param string $value
     * @return Age
     * @throws \ReflectionException
     */
    public static function createFromString(string $value): self
    {
        return new static(Integer::createFromString($value));
    }

    /**
     * @param int $value
     * @return Age
     * @throws \ReflectionException
     */
    public static function createFromInt(int $value): self
    {
        return new static(new Integer($value));
    }
}
