<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\SlackLoggerHandler;

use Fer\Deli\Extend\SlackLoggerHandler\Annotation\SlackLogger;
use Psr\Log\LoggerInterface;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

class SlackLoggerHandlerModule extends AbstractModule
{
    public function __construct(
        private string $webhook,
        private string $channel,
        private string $username,
        ?AbstractModule $module = null
    ) {
        parent::__construct($module);
    }

    protected function configure(): void
    {
        $this->bind()->annotatedWith('slack_webhook_url')->toInstance($this->webhook);
        $this->bind()->annotatedWith('slack_channel')->toInstance($this->channel);
        $this->bind()->annotatedWith('slack_username')->toInstance($this->username);
        $this->bind(LoggerInterface::class)->annotatedWith(SlackLogger::class)
            ->toProvider(SlackLoggerHandlerProvider::class)
            ->in(Scope::SINGLETON);
    }
}
