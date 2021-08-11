<?php

declare(strict_types=1);

namespace Fer\Deli\UseCase;

use Fer\Deli\Service\SmartLock\Actor\Room;
use Fer\Deli\Service\SmartLock\Unlock;

use function sprintf;

class UnlockSesameDevice
{
    public function __construct(
        private Unlock $unlock,
        private GetInformationSesameDevice $status
    ) {
    }

    public function execute(string $roomId, string $executor): string
    {
        $room = new Room($roomId);
        $device = $this->status->get($room);
        if ($device['status'] === 'unlocked') {
            return sprintf('%sの鍵はすでにあいています。', $room->getName());
        }

        $result = $this->unlock->run($room, $executor);
        if ($result) {
            return sprintf('%sの鍵をあけました。', $room->getName());
        }

        return sprintf('%sの鍵をあけることができませんでした。オフィスサークルへご連絡ください。', $room->getName());
    }
}
