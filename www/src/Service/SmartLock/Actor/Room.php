<?php

declare(strict_types=1);

namespace Fer\Deli\Service\SmartLock\Actor;

use MyCLabs\Enum\Enum;

/**
 * @psalm-immutable
 */
class Room extends Enum
{
    public const HANOI = 'hanoi';
    public const CAIRO = 'cairo';

    /** @var array<string, string> */
    private static array $name = [
        self::HANOI => 'ノーサイ-2F-長-ハノイ（Ha noi）',
        self::CAIRO => 'ノーサイ-2F-中-カイロ（Cairo）',
    ];

    /**
     * @psalm-pure
     */
    public function getName(): string
    {
        return self::$name[$this->getValue()];
    }
}
