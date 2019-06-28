<?php

declare(strict_types=1);

namespace DBUnt1tled\Test\Unit\VObjects\Identity;

use DBUnt1tled\Test\MyCase;
use DBUnt1tled\VO\Exception\InvalidVOArgumentException;
use DBUnt1tled\VO\VObjects\Identity\Md5;
use DBUnt1tled\VO\VObjects\Scalar\Strings;

final class Md5Test extends MyCase
{
    /**
     * @throws \ReflectionException
     */
    public function testMd5(): void
    {
        $md51 = new Md5(new Strings('0c0b3da4ac402bd86191d959be081114'));
        $this->assertEquals('0c0b3da4ac402bd86191d959be081114', $md51->getValue());

        $md52 = Md5::createFromString('0aa1ea9a5a04b78d4581dd6d17742627');
        $this->assertEquals('0aa1ea9a5a04b78d4581dd6d17742627', $md52->getValue());

        $md53 = Md5::generateFromValue('2334asfasfasdfWF$@$@#@SLDSLDSLDJLCN');
        $this->assertEquals('e0110b3d3bc04c4ea07743e7cf077751', $md53->getValue());
    }

    public function testException(): void
    {
        $this->assertException(InvalidVOArgumentException::class, function () {
            Md5::createFromString('0aa1ea9a5a04b78d458sdd6d17742627');
        });

        $this->assertException(InvalidVOArgumentException::class, function () {
            Md5::createFromString('0aa1ea9a5a04b78d458dd6d17742627');
        });
    }
}
