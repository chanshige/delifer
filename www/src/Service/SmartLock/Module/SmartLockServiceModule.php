<?php

declare(strict_types=1);

namespace Fer\Deli\Service\SmartLock\Module;

use Fer\Deli\Service\SmartLock\Device\Hanoi;
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
                new Hanoi(getenv('SESAME_DEVICE_ID_HANOI'), getenv('SESAME_DEVICE_KEY_HANOI')),
            ]);
        $this->bind(DeviceResolverInterface::class)
            ->to(DeviceResolver::class)
            ->in(Scope::SINGLETON);
    }
}
