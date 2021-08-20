<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\Console;

use Fer\Deli\Extend\Console\Contracts\InputInterface;
use Fer\Deli\Extend\Console\Exception\InputException;
use Symfony\Component\String\UnicodeString;

use function sprintf;

final class Input implements InputInterface
{
    /** @var array<string, mixed> $arguments */
    private array $arguments = [];

    public function __construct(
        private string $text,
        private Definition $definition
    ) {
    }

    public function parse(string $delimiter = ' '): self
    {
        $token = (new UnicodeString($this->text))->collapseWhitespace();

        $parsed = ! $token->isEmpty() ? $token->split($delimiter) : [];

        foreach ($this->definition->getArguments() as $key => $argument) {
            if (! isset($parsed[$key]) && $argument->isRequired()) {
                throw new InputException(sprintf('Not enough arguments (missing: "%s")', $argument->getName()));
            }

            $this->arguments[$argument->getName()] = (string) ($parsed[$key] ?? $argument->getDefault());
        }

        return $this;
    }

    public function getArgument(string $name): mixed
    {
        if (! isset($this->arguments[$name])) {
            throw new InputException(sprintf('The "%s" argument does not exist.', $name));
        }

        return $this->arguments[$name];
    }

    /**
     * @return array<string, mixed>
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }
}
