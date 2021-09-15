<?php

declare(strict_types=1);

namespace Fer\Deli\Service\SmartLock\Module;

use Fer\Deli\Service\SmartLock\Device;
use Fer\Deli\Service\SmartLock\DeviceResolver;
use Fer\Deli\Service\SmartLock\DeviceResolverInterface;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

use function getenv;

class SmartLockServiceModule extends AbstractModule
{
    protected function configure(): void
    {
        $this->bind()
            ->annotatedWith('sesame_devices')
            ->toInstance([
                new Device\Hanoi(getenv('SESAME_DEVICE_ID_HANOI') ?: '', getenv('SESAME_DEVICE_KEY_HANOI') ?: ''),
                new Device\Cairo(getenv('SESAME_DEVICE_ID_CAIRO') ?: '', getenv('SESAME_DEVICE_KEY_CAIRO') ?: ''),
            ]);
        $this->bind(DeviceResolverInterface::class)
            ->to(DeviceResolver::class)
            ->in(Scope::SINGLETON);
    }
}
