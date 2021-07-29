<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\Console\Contracts;

interface InputInterface
{
    public function parse(string $delimiter = ' '): void;

    public function getArgument(string $name): mixed;

    /**
     * @return array<string, mixed>
     */
    public function getArguments(): array;
}
