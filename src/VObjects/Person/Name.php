<?php

declare(strict_types=1);

namespace DBUnt1tled\VO\VObjects\Person;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Scalar\Strings;
use DBUnt1tled\VO\VObjects\ValueObjectComplex;
use DBUnt1tled\VO\VObjects\ValueObjectInterface;

class Name extends ValueObjectComplex
{
    public const NAME_MIN_LENGTH = 4;
    /** @var Strings */
    private $firstName;
    /** @var Strings */
    private $lastName;

    /**
     * Name constructor.
     * @param Strings $firstName
     * @param Strings $lastName
     * @throws \ReflectionException
     */
    public function __construct(Strings $firstName, Strings $lastName)
    {
        $this->guard($firstName, $lastName);
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @param mixed $value
     * @param mixed ...$other
     * @throws \ReflectionException
     */
    public function guard($value, ...$other): void
    {
        parent::guard($value);
        /** @var ValueObjectInterface $value*/
        parent::guard($other[0]);
        /** @var ValueObjectInterface[] $other*/
        if (mb_strlen($value->getValue())< self::NAME_MIN_LENGTH) {
            throw new InvalidVOArgumentException(sprintf('First name must contain a minimum of %s symbols.', self::NAME_MIN_LENGTH), $value);
        }
        if (mb_strlen($other[0]->getValue())< self::NAME_MIN_LENGTH) {
            throw new InvalidVOArgumentException(sprintf('Last name must contain a minimum of %s symbols.', self::NAME_MIN_LENGTH), $value);
        }
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @return Name
     * @throws \ReflectionException
     */
    public static function createFromString(string $firstName, string $lastName)
    {
        return new static(new Strings($firstName), new Strings($lastName));
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName->getValue();
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName->getValue();
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->firstName->getValue() .' '.$this->lastName->getValue();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getFullName();
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->getFullName();
    }
}
