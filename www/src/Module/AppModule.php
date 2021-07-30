<?php

declare(strict_types=1);

namespace Fer\Deli\Module;

use BEAR\Dotenv\Dotenv;
use BEAR\Package\AbstractAppModule;
use BEAR\Package\PackageModule;
use BEAR\Resource\Module\AttributeModule;
use Fer\Deli\Extend\CandyHouse\Module\SesameModule;
use Fer\Deli\Extend\SlackLoggerHandler\SlackLoggerHandlerModule;
use Fer\Deli\Extend\VerifySlackRequestSignature\VerifySlackRequestSignatureModule;
use Fer\Deli\Service\Formatter\Module\FormatterModule;
use Fer\Deli\Service\SmartLock\Module\SmartLockServiceModule;

use function dirname;
use function getenv;

class AppModule extends AbstractAppModule
{
    protected function configure(): void
    {
        (new Dotenv())->load(dirname(__DIR__, 2));
        $this->install(new PackageModule());
        $this->install(new AttributeModule());
        // Extend...
        $this->install(new SlackLoggerHandlerModule(
            getenv('LOG_SLACK_WEBHOOK_URL'),
            getenv('LOG_SLACK_CHANNEL'),
            getenv('LOG_SLACK_USERNAME')
        ));
        $this->install(new SesameModule(getenv('SESAME_API_KEY')));
        $this->install(new VerifySlackRequestSignatureModule(getenv('SLACK_SIGNING_SECRET')));
        // Service...
        $this->install(new FormatterModule());
        $this->install(new SmartLockServiceModule());
    }
}
