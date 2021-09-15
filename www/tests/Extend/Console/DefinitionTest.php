<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\Console;

use PHPUnit\Framework\TestCase;

class DefinitionTest extends TestCase
{
    public function testDefinition(): void
    {
        $definition = new Definition([new Argument('arg1', Argument::REQUIRED, null)]);
        $definition->setArgument('arg2', Argument::OPTIONAL, 'default');

        $this->assertEquals(
            [
                new Argument('arg1', Argument::REQUIRED, null),
                new Argument('arg2', Argument::OPTIONAL, 'default'),
            ],
            $definition->getArguments()
        );
    }
}
