<?php

declare(strict_types=1);

namespace DBUnt1tled\VO\VObjects;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;

abstract class ValueObjectComplex extends ValueObject
{

    /**
     * @param mixed $value
     * @param mixed ...$other
     * @throws \ReflectionException
     */
    public function guard($value, ...$other): void
    {
        if (!$value instanceof ValueObjectInterface) {
            throw new InvalidVOArgumentException(sprintf('%s cannot create by base type.', $this->getReflection()->getShortName()), $this->value);
        }
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        /** @var ValueObjectInterface $vo */
        $vo = parent::getValue();
        return $vo->getValue();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $vo = $this->getValue();
        if (is_scalar($vo)) {
            return (string)$vo;
        }
        return (string)json_encode($vo, 320);
    }
}
