<?php

declare(strict_types=1);

namespace DBUnt1tled\Test\Unit\VObjects\Internet;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Internet\Url;
use DBUnt1tled\VO\VObjects\Scalar\Strings;

final class UrlTest extends MyCase
{
    /**
     * @throws \ReflectionException
     */
    public function testUrl(): void
    {
        $url1 = new Url(new Strings('http://localhost'));
        $this->assertEquals('http://localhost', $url1->getValue());

        $url2 = Url::createFromString('http://127.0.0.1');
        $this->assertEquals('http://127.0.0.1', $url2->getValue());

        $url3 = Url::createFromString('http://127.0.0.1/test.php?var1=12&var2=%C2%BA');
        $this->assertEquals('http://127.0.0.1/test.php?var1=12&var2=%C2%BA', $url3->getValue());

        $url4 = Url::createFromString('https://example.com/test');
        $this->assertEquals('https://example.com/test', $url4->getValue());
    }

    public function testException(): void
    {
        $this->assertException(InvalidVOArgumentException::class, function () {
            Url::createFromString('//example.com/test');
        });
    }
}
