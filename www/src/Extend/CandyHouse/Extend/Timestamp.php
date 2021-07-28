<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\CandyHouse\Extend;

use DateTimeImmutable;

final class Timestamp
{
    public static function now(): int
    {
        return (new DateTimeImmutable())->getTimestamp();
    }
}
