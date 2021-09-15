<?php

declare(strict_types=1);

namespace Fer\Deli\UseCase;

use Fer\Deli\Service\SmartLock\Actor\Room;
use Fer\Deli\Service\SmartLock\Lock;

use function sprintf;

class LockSesameDevice
{
    public function __construct(
        private Lock $lock,
        private GetInformationSesameDevice $status
    ) {
    }

    public function execute(string $roomId, string $executor): string
    {
        $room = new Room($roomId);
        $device = $this->status->get($room);
        if ($device['status'] === 'locked') {
            return sprintf('%sの鍵はすでにかけられています。', $room->getName());
        }

        $result = $this->lock->run($room, $executor);
        if ($result) {
            return sprintf('%sの鍵をかけました。', $room->getName());
        }

        return sprintf('%sの鍵をかけることができませんでした。オフィスサークルへご連絡ください。', $room->getName());
    }
}
