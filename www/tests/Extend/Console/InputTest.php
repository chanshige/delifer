<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\Console;

use Fer\Deli\Extend\Console\Exception\InputException;
use PHPUnit\Framework\TestCase;

class InputTest extends TestCase
{
    public function testInput(): void
    {
        $define = (new Definition())
            ->setArgument('kbr_name', Argument::REQUIRED)
            ->setArgument('last_name');

        $input = new Input('bell tanaka', $define);
        $input->parse();

        $this->assertEquals('bell', $input->getArgument('kbr_name'));
        $this->assertEquals('tanaka', $input->getArgument('last_name'));
    }

    public function testAllOptionalEmpty(): void
    {
        $define = (new Definition())
            ->setArgument('argument')
            ->setArgument('argument2');

        $input = new Input('', $define);
        $input->parse();

        $this->assertEquals('', $input->getArgument('argument'));
        $this->assertEquals('', $input->getArgument('argument2'));
    }

    public function testAllOptionalDefault(): void
    {
        $define = (new Definition())
            ->setArgument('argument', Argument::OPTIONAL, 'empty_var')
            ->setArgument('argument2');

        $input = new Input('', $define);
        $input->parse();

        $this->assertEquals('empty_var', $input->getArgument('argument'));
        $this->assertEquals('', $input->getArgument('argument2'));
    }

    public function testAllOptionalWithInputDefault(): void
    {
        $define = (new Definition())
            ->setArgument('argument')
            ->setArgument('argument2', Argument::OPTIONAL, 'default_var');

        $input = new Input('input_var', $define);
        $input->parse();

        $this->assertEquals('input_var', $input->getArgument('argument'));
        $this->assertEquals('default_var', $input->getArgument('argument2'));
    }

    public function testEmptyException(): void
    {
        $this->expectException(InputException::class);
        $this->expectExceptionMessage('Not enough arguments (missing: "argument")');

        $define = (new Definition())->setArgument('argument', Argument::REQUIRED);
        (new Input('', $define))->parse();
    }

    public function testNotArgException(): void
    {
        $this->expectException(InputException::class);
        $this->expectExceptionMessage('The "argument" argument does not exist.');

        $define = (new Definition())->setArgument('arg');
        $input = new Input('', $define);
        $input->parse();

        $input->getArgument('argument');
    }
}
