<?php

declare(strict_types=1);

namespace Fer\Deli\Service\SmartLock\Actor;

use MyCLabs\Enum\Enum;

class Room extends Enum
{
    public const HANOI = 'hanoi';

    /** @var array<string, string> */
    private static array $name = [self::HANOI => 'ノーサイ-2F-長-ハノイ（Ha noi）'];

    public function getName(): string
    {
        return self::$name[$this->getValue()];
    }
}