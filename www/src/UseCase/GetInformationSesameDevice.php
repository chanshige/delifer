<?php

declare(strict_types=1);

namespace Fer\Deli\UseCase;

use Fer\Deli\Service\Formatter\SesameDeviceFormatterInterface;
use Fer\Deli\Service\SmartLock\Actor\Room;
use Fer\Deli\Service\SmartLock\Status;

class GetInformationSesameDevice
{
    public function __construct(
        private Status $status,
        private SesameDeviceFormatterInterface $formatter
    ) {
    }

    /**
     * @return array{room_name: string, status: string, battery_level: string, battery_voltage: string, updated_at: string}
     */
    public function get(Room|string $id): array
    {
        $room = $id instanceof Room ? $id : new Room($id);

        return $this->formatter->format($room, $this->status->run($room));
    }
}
