<?php

declare(strict_types=1);

namespace Fer\Deli\UseCase;

use Fer\Deli\Service\Formatter\SesameDeviceFormatterInterface;
use Fer\Deli\Service\SmartLock\Actor\Room;
use Fer\Deli\Service\SmartLock\Status;

class GetInformationSesameDevices
{
    public function __construct(
        private Status $status,
        private SesameDeviceFormatterInterface $formatter
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
            $devices[$room->getValue()] = $this->formatter->format($room, $deviceInfo);
        }

        return $devices;
    }
}
