<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\Console;

final class Definition
{
    /**
     *  @param Argument[] $arguments
     */
    public function __construct(
        private array $arguments = []
    ) {
    }

    public function setArgument(string $name, int $mode = Argument::OPTIONAL, mixed $default = null): self
    {
        $this->arguments[] = new Argument($name, $mode, $default);

        return $this;
    }

    /**
     * @return Argument[]
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }
}
