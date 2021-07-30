<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\CandyHouse\Module;

use Fer\Deli\Extend\CandyHouse\Contracts\SesameInterface;
use Fer\Deli\Extend\CandyHouse\Provider\GuzzleProvider;
use Fer\Deli\Extend\CandyHouse\Sesame;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
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
        $this->bind(GuzzleClientInterface::class)
            ->annotatedWith('sesame_client')
            ->toProvider(GuzzleProvider::class);
        $this->bind(SesameInterface::class)
            ->to(Sesame::class)
            ->in(Scope::SINGLETON);
    }
}
