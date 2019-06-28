<?php

declare(strict_types=1);

namespace DBUnt1tled\VO\VObjects\Person;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Scalar\Strings;
use DBUnt1tled\VO\VObjects\ValueObjectInterface;

class NameExtended extends Name
{
    /** @var Strings */
    private $middleName;

    /**
     * NameExtended constructor.
     * @param Strings $firstName
     * @param Strings $middleName
     * @param Strings $lastName
     * @throws \ReflectionException
     */
    public function __construct(Strings $firstName, Strings $middleName, Strings $lastName)
    {
        parent::__construct($firstName, $lastName);
        $this->guardExtended($middleName);
        $this->middleName = $middleName;
    }

    /**
     * @param $value
     * @param mixed ...$other
     */
    public function guardExtended($value, ...$other): void
    {
        /** @var ValueObjectInterface $value*/
        if (mb_strlen($value->getValue())< self::NAME_MIN_LENGTH) {
            throw new InvalidVOArgumentException(sprintf('Middle name must contain a minimum of %s symbols.', self::NAME_MIN_LENGTH), $value);
        }
    }

    /**
     * @param string $firstName
     * @param string $middleName
     * @param string $lastName
     * @return NameExtended
     * @throws \ReflectionException
     */
    public static function createFromString(string $firstName, string $middleName, string $lastName = ''): self
    {
        return new static(new Strings($firstName), new Strings($middleName), new Strings($lastName));
    }

    /**
     * @return string
     */
    public function getMiddleName(): string
    {
        return $this->middleName->getValue();
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->getFirstName() .' '.$this->getMiddleName() .' '. $this->getLastName();
    }
}
