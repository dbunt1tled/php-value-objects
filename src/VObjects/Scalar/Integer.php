<?php
/**
 * This file is part of True Loaded.
 *
 * @link http://www.holbi.co.uk
 * @copyright Copyright (c) 2005 Holbi Group LTD
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */
declare(strict_types=1);


namespace DBUnt1tled\VO\VObjects\Scalar;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\ValueObject;

class Integer extends ValueObject
{
    /**
     * @param mixed $value
     * @param mixed ...$other
     * @throws \ReflectionException
     */
    public function guard($value, ...$other): void
    {
        parent::guard($value);
        if (!\is_int($value)) {
            throw new InvalidVOArgumentException('Value is invalid. Allowed type is integer', $value);
        }
    }

    /**
     * @param bool $bool
     * @return Integer
     * @throws \ReflectionException
     */
    public static function createFromBool(bool $bool): self
    {
        return new static((int)$bool);
    }

    /**
     * @param string $string
     * @return Integer
     * @throws \ReflectionException
     */
    public static function createFromString(string $string): self
    {
        if (filter_var($string, FILTER_VALIDATE_INT) !== false) {
            return new static((int)$string);
        }
        throw new InvalidVOArgumentException('Value is invalid. Allowed type is integer, float, double, real', $string);
    }
}
