<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\CandyHouse\Contracts;

interface CommandActionInterface extends ActionInterface
{
    public const LOCK = 82;
    public const UNLOCK = 83;
    public const TOGGLE = 88;

    public function history(string $note): self;
}
