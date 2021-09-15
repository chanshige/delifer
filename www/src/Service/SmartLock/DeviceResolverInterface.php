<?php

declare(strict_types=1);

namespace Fer\Deli\Service\SmartLock;

use Fer\Deli\Service\SmartLock\Device\DeviceInterface;

interface DeviceResolverInterface
{
    public function resolve(string $name): DeviceInterface;
}
