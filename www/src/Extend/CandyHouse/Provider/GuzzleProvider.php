<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\CandyHouse\Provider;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Ray\Di\ProviderInterface;

class GuzzleProvider implements ProviderInterface
{
    public function get(): ClientInterface
    {
        return new Client(
            [
                RequestOptions::TIMEOUT => 3,
                RequestOptions::DELAY => 500.0, // 0.5s
            ]
        );
    }
}
