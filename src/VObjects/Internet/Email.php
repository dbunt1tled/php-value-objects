<?php

declare(strict_types=1);

namespace DBUnt1tled\VO\VObjects\Internet;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Scalar\Strings;
use DBUnt1tled\VO\VObjects\ValueObjectComplex;
use DBUnt1tled\VO\VObjects\ValueObjectInterface;

class Email extends ValueObjectComplex
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
        if (filter_var($value->getValue(), FILTER_VALIDATE_EMAIL) === false) {
            throw new InvalidVOArgumentException('Value is not a valid e-mail address.', $value);
        }
    }

    /**
     * @return string
     */
    public function userName(): string
    {
        return $this->getEmailParts()[0];
    }

    /**
     * @return string
     */
    public function domain(): string
    {
        return $this->getEmailParts()[1];
    }

    /**
     * @param string $value
     * @return Email
     * @throws \ReflectionException
     */
    public static function createFromString(string $value): self
    {
        return new static(new Strings($value));
    }

    /**
     * @return array
     */
    private function getEmailParts(): array
    {
        return explode('@', $this->getValue());
    }
}
