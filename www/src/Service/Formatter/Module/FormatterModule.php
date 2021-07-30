<?php

declare(strict_types=1);

namespace Fer\Deli\Service\Formatter\Module;

use Fer\Deli\Service\Formatter\SesameDeviceFormatter;
use Fer\Deli\Service\Formatter\SesameDeviceFormatterInterface;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

class FormatterModule extends AbstractModule
{
    protected function configure(): void
    {
        $this->bind(SesameDeviceFormatterInterface::class)
            ->to(SesameDeviceFormatter::class)->in(Scope::SINGLETON);
    }
}
