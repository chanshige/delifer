<?php

declare(strict_types=1);

namespace Fer\Deli\Service\SmartLock\Device;

use Fer\Deli\Service\SmartLock\Actor\Room;

final class Cairo implements DeviceInterface
{
    public function __construct(
        private string $uuid,
        private string $key,
    ) {
    }

    public function supports(string $name): bool
    {
        return $name === Room::CAIRO;
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    public function key(): string
    {
        return $this->key;
    }
}
