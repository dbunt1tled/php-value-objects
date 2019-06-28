<?php

declare(strict_types=1);

namespace DBUnt1tled\VO\VObjects\Identity;

use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Scalar\Strings;
use DBUnt1tled\VO\VObjects\ValueObjectComplex;
use DBUnt1tled\VO\VObjects\ValueObjectInterface;

class Uuid extends ValueObjectComplex
{
    /** @var null|string */
    protected $version;

    /**
     * UUID NIL & version binary masks
     */
    public const UUID_VALID = 'valid';
    public const UUID_NIL   = 'nil';
    public const UUID_V1    = 'v1';
    public const UUID_V2    = 'v2';
    public const UUID_V3    = 'v3';
    public const UUID_V4    = 'v4';
    public const UUID_V5    = 'v5';

    /**
     * @var array
     */
    protected $regexes = [
        self::UUID_NIL   => '/^[0]{8}-[0]{4}-[0]{4}-[0]{4}-[0]{12}$/i',
        self::UUID_V1    => '/^[0-9A-F]{8}-[0-9A-F]{4}-1[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i',
        self::UUID_V2    => '/^[0-9A-F]{8}-[0-9A-F]{4}-2[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i',
        self::UUID_V3    => '/^[0-9A-F]{8}-[0-9A-F]{4}-3[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i',
        self::UUID_V4    => '/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i',
        self::UUID_V5    => '/^[0-9A-F]{8}-[0-9A-F]{4}-5[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i',
        self::UUID_VALID => '/^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/i',
    ];

    /**
     * An array of all validation regexes.
     *
     * @var array
     */
    protected $versionNames = [
        self::UUID_V1,
        self::UUID_V2,
        self::UUID_V3,
        self::UUID_V4,
        self::UUID_V5,
        self::UUID_VALID,
        self::UUID_NIL,
    ];

    /**
     * Uuid constructor.
     * @param Strings $uuid
     * @param string|null $version
     * @throws \ReflectionException
     */
    public function __construct(Strings $uuid, string $version = null)
    {
        $this->guard($uuid, $version);
        $this->value = $uuid;
    }

    /**
     * @param mixed $value
     * @param null $vesion
     * @param mixed ...$other
     * @throws \ReflectionException
     */
    public function guard($value, $vesion = null, ...$other): void
    {
        /** @var ValueObjectInterface $value*/
        parent::guard($value);
        if (is_string($vesion) && in_array($vesion, $this->versionNames, true)) {
            if (true === (bool)preg_match($this->regexes[$vesion], $value->getValue())) {
                $this->version = $vesion;
                return;
            }
            throw new InvalidVOArgumentException(sprintf('Value is not a valid uuid %s.', $vesion), $value);
        }
        foreach ($this->regexes as $ver => $regex) {
            if (true === (bool)preg_match($regex, $value->getValue())) {
                $this->version = $ver;
                return;
            }
        }
        throw new InvalidVOArgumentException('Value is not a valid uuid.', $value);
    }

    /**
     * @param string $value
     * @param string|null $version
     * @return Uuid
     * @throws \ReflectionException
     */
    public static function createFromString(string $value, ?string $version = null): self
    {
        return new static(new Strings($value), $version);
    }

    /**
     * @return null|string
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }
}
