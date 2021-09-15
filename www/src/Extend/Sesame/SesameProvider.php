<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\Sesame;

use Chanshige\SmartLock\Sesame;
use Ray\Di\Di\Named;
use Ray\Di\ProviderInterface;

class SesameProvider implements ProviderInterface
{
    #[Named('sesame_api_key')]
    public function __construct(
        private string $apiKey
    ) {
    }

    public function get(): Sesame
    {
        return Sesame::newInstance($this->apiKey);
    }
}
