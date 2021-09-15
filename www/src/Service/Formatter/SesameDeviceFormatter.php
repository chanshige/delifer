<?php

declare(strict_types=1);

namespace Fer\Deli\Service\Formatter;

use DateTimeImmutable;
use DateTimeZone;
use Fer\Deli\Service\SmartLock\Actor\Room;

use function number_format;

final class SesameDeviceFormatter implements SesameDeviceFormatterInterface
{
    /**
     * {@inheritdoc}
     */
    public function format(Room $room, array $data): array
    {
        return [
            'room_name' => $room->getName(),
            'status' => $data['CHSesame2Status'], // locked | unlocked | moved
            'battery_level' => $data['batteryPercentage'] . '%',
            'battery_voltage' => number_format($data['batteryVoltage'], 2) . 'V',
            'updated_at' => $this->convertTimestamp((string) $data['timestamp']),
        ];
    }

    private function convertTimestamp(string $timestamp): string
    {
        $dateTime = DateTimeImmutable::createFromFormat('U', $timestamp);
        if (! $dateTime) {
            return '';
        }

        return $dateTime->setTimezone(new DateTimeZone('Asia/Tokyo'))
            ->format('Y-m-d H:i:s');
    }
}
