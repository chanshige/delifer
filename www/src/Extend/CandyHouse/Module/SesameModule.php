<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\CandyHouse\Module;

use Fer\Deli\Extend\CandyHouse\Contracts\SesameInterface;
use Fer\Deli\Extend\CandyHouse\Provider\GuzzleProvider;
use Fer\Deli\Extend\CandyHouse\Sesame;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

use function getenv;

class SesameModule extends AbstractModule
{
    protected function configure(): void
    {
        $this->bind()->annotatedWith('sesame_api_key')->toInstance(getenv('SESAME_API_KEY'));
        $this->bind(GuzzleClientInterface::class)
            ->annotatedWith('sesame_client')
            ->toProvider(GuzzleProvider::class);
        $this->bind(SesameInterface::class)
            ->to(Sesame::class)
            ->in(Scope::SINGLETON);
    }
}
