<?php

declare(strict_types=1);


namespace DBUnt1tled\VO\VObjects;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;

abstract class ValueObject implements ValueObjectInterface
{
    /** @var mixed */
    protected $value;

    /**
     * ValueObject constructor.
     * @param $value
     * @throws \ReflectionException
     */
    public function __construct($value)
    {
        $this->guard($value);
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if (is_scalar($this->value)) {
            return (string)$this->value;
        }
        return (string)json_encode($this->value, 320);
    }

    /**
     * @param \DBUnt1tled\VO\VObjects\ValueObjectInterface $other
     * @return bool
     */
    public function equals(ValueObjectInterface $other): bool
    {
        if (get_class($this) !== get_class($other)) {
            throw new InvalidVOArgumentException(
                sprintf(
                    'A Value Object of type %s can not be compared to another of type %s',
                    get_class($this),
                    get_class($other)
                ),
                [
                    'original' => $this,
                    'destination' => $other
                ]
            );
        }
        return $this->getValue() === $other->getValue();
    }

    /**
     * @param mixed $value
     * @param mixed ...$other
     * @throws \ReflectionException
     */
    public function guard($value, ...$other): void
    {
        if ($value === null) {
            throw new InvalidVOArgumentException(sprintf('%s cannot be empty.', $this->getReflection()->getShortName()), $this->value);
        }
    }

    /**
     * @return \ReflectionClass
     * @throws \ReflectionException
     */
    protected function getReflection(): \ReflectionClass
    {
        return new \ReflectionClass(static::class);
    }
}
