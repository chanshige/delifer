<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\SlackLoggerHandler;

use Monolog\Handler\SlackWebhookHandler;
use Monolog\Logger;
use Ray\Di\Di\Named;
use Ray\Di\ProviderInterface;

class SlackLoggerHandlerProvider implements ProviderInterface
{
    #[Named('webhook=slack_webhook_url, channel=slack_channel, username=slack_username')]
    public function __construct(
        private string $webhook,
        private string $channel,
        private string $username = 'DELIFER'
    ) {
    }

    public function get()
    {
        return (new Logger('delifer_logger'))
            ->pushHandler((new SlackWebhookHandler(
                $this->webhook,
                $this->channel,
                $this->username
            ))->setLevel(Logger::INFO));
    }
}
