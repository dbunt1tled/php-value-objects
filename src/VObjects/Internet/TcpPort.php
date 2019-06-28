<?php

declare(strict_types=1);

namespace DBUnt1tled\VO\VObjects\Internet;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Scalar\Integer;
use DBUnt1tled\VO\VObjects\ValueObjectComplex;
use DBUnt1tled\VO\VObjects\ValueObjectInterface;

class TcpPort extends ValueObjectComplex
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
        if ($v < 0 || $v > 65535) {
            throw new InvalidVOArgumentException('Value is not a valid tcp port.', $value);
        }
    }

    /**
     * @param string $value
     * @return TcpPort
     * @throws \ReflectionException
     */
    public static function createFromString(string $value): self
    {
        return new static(Integer::createFromString($value));
    }

    /**
     * @param int $value
     * @return TcpPort
     * @throws \ReflectionException
     */
    public static function createFromInt(int $value): self
    {
        return new static(new Integer($value));
    }
}
