<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\CandyHouse\Action;

use function sprintf;

final class Status extends AbstractAction
{
    public function __construct(
        private string $uuid
    ) {
    }

    public function method(): string
    {
        return self::GET;
    }

    public function __toString(): string
    {
        return sprintf('/sesame2/%s', $this->uuid);
    }
}
