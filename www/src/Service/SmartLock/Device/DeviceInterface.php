<?php

declare(strict_types=1);

namespace Fer\Deli\Service\SmartLock\Device;

interface DeviceInterface
{
    public function supports(string $name): bool;

    public function uuid(): string;

    public function key(): string;
}
