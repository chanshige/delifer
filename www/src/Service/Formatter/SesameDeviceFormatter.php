<?php

declare(strict_types=1);

namespace Fer\Deli\Service\Formatter;

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
            'state' => $data['CHSesame2Status'],
            'battery_level' => $data['batteryPercentage'] . '%',
            'battery_voltage' => number_format($data['batteryVoltage'], 2) . 'V',
        ];
    }
}
