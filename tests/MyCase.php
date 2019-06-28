<?php

declare(strict_types=1);

namespace DBUnt1tled\Test;

use PHPUnit\Framework\TestCase;

class MyCase extends TestCase
{
    /**
     * Asserts that the given callback throws the given exception.
     *
     * @param string $expectClass The name of the expected exception class
     * @param callable $callback A callback which should throw the exception
     */
    protected function assertException(string $expectClass, callable $callback): void
    {
        try {
            $callback();
        } catch (\Throwable $exception) {
            $this->assertInstanceOf($expectClass, $exception, 'An invalid exception was thrown');
            return;
        }
        $this->fail('No exception was thrown');
    }
}
