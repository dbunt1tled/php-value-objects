<?php

declare(strict_types=1);

namespace DBUnt1tled\VO\VObjects\Person;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Scalar\Strings;
use DBUnt1tled\VO\VObjects\ValueObjectComplex;
use DBUnt1tled\VO\VObjects\ValueObjectInterface;

class Password extends ValueObjectComplex
{
    public const PASSWORD_MIN_LENGTH = 8;
    public const PASSWORD_MAX_LENGTH = 20;

    /**
     * @param mixed $value
     * @param mixed ...$other
     * @throws \ReflectionException
     */
    public function guard($value, ...$other): void
    {
        parent::guard($value);
        /** @var ValueObjectInterface $value*/
        $pwd = $value->getValue();
        $error = '';
        if (mb_strlen($pwd) < 8) {
            $error .= 'Password too short!';
        }

        if (mb_strlen($pwd) > 20) {
            $error .= "Password too long!\n";
        }

        if (!preg_match('#[\d]+#', $pwd)) {
            $error .= "Password must include at least one number!\n";
        }

        if (!preg_match('#[a-z]+#', $pwd)) {
            $error .= "Password must include at least one letter!\n";
        }

        if (!preg_match('#[A-Z]+#', $pwd)) {
            $error .= "Password must include at least one CAPS!\n";
        }

        if (!preg_match('#\W+#', $pwd)) {
            $error .= "Password must include at least one symbol!\n";
        }

        if ($error !== '') {
            throw new InvalidVOArgumentException($error, $value);
        }
    }

    /**
     * @param string $value
     * @return Password
     * @throws \ReflectionException
     */
    public static function createFromString(string $value): self
    {
        return new static(new Strings($value));
    }
}
