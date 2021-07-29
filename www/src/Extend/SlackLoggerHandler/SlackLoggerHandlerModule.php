<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\SlackLoggerHandler;

use Fer\Deli\Extend\SlackLoggerHandler\Annotation\SlackLogger;
use Psr\Log\LoggerInterface;
use Ray\Di\AbstractModule;

use function getenv;

class SlackLoggerHandlerModule extends AbstractModule
{
    protected function configure(): void
    {
        $this->bind()->annotatedWith('slack_webhook_url')->toInstance(getenv('LOG_SLACK_WEBHOOK_URL'));
        $this->bind()->annotatedWith('slack_channel')->toInstance(getenv('LOG_SLACK_CHANNEL'));
        $this->bind()->annotatedWith('slack_username')->toInstance(getenv('LOG_SLACK_USERNAME'));
        $this->bind(LoggerInterface::class)->annotatedWith(SlackLogger::class)
            ->toProvider(SlackLoggerHandlerProvider::class);
    }
}
