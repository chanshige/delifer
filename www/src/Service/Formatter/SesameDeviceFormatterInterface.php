<?php

declare(strict_types=1);

namespace Fer\Deli\Service\Formatter;

use Fer\Deli\Service\SmartLock\Actor\Room;

interface SesameDeviceFormatterInterface
{
    /**
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    public function format(Room $room, array $data): array;
}
