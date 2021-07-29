<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\Console;

use LogicException;
use PHPUnit\Framework\TestCase;

class ArgumentTest extends TestCase
{
    public function testArgument(): void
    {
        $argument = new Argument('test', Argument::OPTIONAL, 'default');
        $this->assertEquals('test', $argument->getName());
        $this->assertEquals('default', $argument->getDefault());
        $this->assertFalse($argument->isRequired());
    }

    public function testException(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Cannot set a default value except for Argument::OPTIONAL mode.');

        new Argument('test', Argument::REQUIRED, 'default');
    }
}
