<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\CandyHouse\Action;

use Fer\Deli\Extend\CandyHouse\Contracts\ActionInterface;

use function array_filter;
use function get_object_vars;

abstract class AbstractAction implements ActionInterface
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public function payload(): array
    {
        return array_filter(get_object_vars($this), static fn ($v) => $v !== null);
    }
}
