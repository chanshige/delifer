<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\CandyHouse\Contracts;

use Koriym\HttpConstants\Method;
use Stringable;

interface ActionInterface extends Stringable
{
    public const GET = Method::GET;
    public const POST = Method::POST;

    /**
     * @return array<string, array<string, mixed>>
     */
    public function payload(): array;

    public function has(): bool;

    public function method(): string;
}
