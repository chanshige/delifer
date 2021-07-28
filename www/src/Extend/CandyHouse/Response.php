<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\CandyHouse;

use Fer\Deli\Extend\CandyHouse\Contracts\ResponseInterface;
use GuzzleHttp\Utils;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

final class Response implements ResponseInterface
{
    public function __construct(
        private PsrResponseInterface $response
    ) {
    }

    public function statusCode(): int
    {
        return $this->response->getStatusCode();
    }

    /**
     * {@inheritdoc}
     */
    public function headers(): array
    {
        return $this->response->getHeaders();
    }

    public function body(): string
    {
        return (string) $this->response->getBody();
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        return Utils::jsonDecode($this->body(), true);
    }
}
