<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\Sesame;

use Chanshige\SmartLock\Contracts\SesameInterface;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

class SesameModule extends AbstractModule
{
    public function __construct(
        private string $apiKey,
        ?AbstractModule $module = null
    ) {
        parent::__construct($module);
    }

    protected function configure(): void
    {
        $this->bind()->annotatedWith('sesame_api_key')->toInstance($this->apiKey);
        $this->bind(SesameInterface::class)
            ->toProvider(SesameProvider::class)
            ->in(Scope::SINGLETON);
    }
}
