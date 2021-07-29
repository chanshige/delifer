<?php

declare(strict_types=1);

namespace Fer\Deli\UseCase;

use Fer\Deli\Service\SmartLock\Actor\Room;
use Fer\Deli\Service\SmartLock\Status;

use function number_format;

class GetInformationSesameDevices
{
    public function __construct(
        private Status $status
    ) {
    }

    /**
     * @return array<string, array>
     */
    public function get(): array
    {
        $devices = [];
        foreach (Room::values() as $room) {
            $deviceInfo = $this->status->run($room);

            $devices[$room->getValue()] = [
                'room_name' => $room->getName(),
                'state' => $deviceInfo['CHSesame2Status'],
                'battery_level' => $deviceInfo['batteryPercentage'] . '%',
                'battery_voltage' => number_format($deviceInfo['batteryVoltage'], 2) . 'V',
            ];
        }

        return $devices;
    }
}
