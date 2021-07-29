<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\Console;

use LogicException;

final class Argument
{
    public const REQUIRED = 1;
    public const OPTIONAL = 0;

    public function __construct(
        private string $name,
        private int $mode,
        private mixed $default
    ) {
        $this->setDefault($this->default);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDefault(): mixed
    {
        return $this->default;
    }

    public function setDefault(mixed $default): void
    {
        if ($this->mode === self::REQUIRED && $default !== null) {
            throw new LogicException('Cannot set a default value except for Argument::OPTIONAL mode.');
        }

        $this->default = $default;
    }

    public function isRequired(): bool
    {
        return (int) ($this->mode === self::REQUIRED) === self::REQUIRED;
    }
}
