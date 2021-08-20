<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\CandyHouse;

use Fer\Deli\Extend\CandyHouse\Contracts\ActionInterface;
use Fer\Deli\Extend\CandyHouse\Contracts\ResponseInterface;
use Fer\Deli\Extend\CandyHouse\Contracts\SesameInterface;
use Fer\Deli\Extend\CandyHouse\Exception\SesameException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Ray\Di\Di\Named;

use function sprintf;

final class Sesame implements SesameInterface
{
    #[Named('client=sesame_client, apiKey=sesame_api_key')]
    public function __construct(
        private ClientInterface $client,
        private string $apiKey
    ) {
    }

    public function __invoke(ActionInterface $action): ResponseInterface
    {
        try {
            $response = $this->client->request(
                $action->method(),
                $this->endpoint((string) $action),
                $this->requestHeaders() + $this->requestOptions($action)
            );

            return new Response($response);
        } catch (GuzzleException $e) {
            throw new SesameException($e->getMessage(), (int) $e->getCode());
        }
    }

    /**
     * @return array<array<string, mixed>>
     */
    private function requestOptions(ActionInterface $action): array
    {
        if (! $action->has()) {
            return [];
        }

        $type = match ($action->method()) {
            ActionInterface::GET => RequestOptions::QUERY,
            ActionInterface::POST => RequestOptions::JSON,
        };

        return [$type => $action->payload()];
    }

    /**
     * @return array<string, array<string, string>>
     */
    private function requestHeaders(): array
    {
        return [
            RequestOptions::HEADERS => [
                'x-api-key' => $this->apiKey,
            ],
        ];
    }

    private function endpoint(string $endpoint): string
    {
        return sprintf('https://app.candyhouse.co/api%s', $endpoint);
    }
}
