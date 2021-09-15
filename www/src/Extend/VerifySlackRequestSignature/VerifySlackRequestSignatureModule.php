<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\VerifySlackRequestSignature;

use BEAR\Resource\ResourceObject;
use Fer\Deli\Extend\VerifySlackRequestSignature\Annotation\SlackRequestVerified;
use Fer\Deli\Extend\VerifySlackRequestSignature\Interceptor\VerifySlackRequestSignatureInterceptor;
use Ray\Di\AbstractModule;
use Ray\HttpMessage\Psr7Module;

class VerifySlackRequestSignatureModule extends AbstractModule
{
    public function __construct(
        private string $signingSecret,
        ?AbstractModule $module = null
    ) {
        parent::__construct($module);
    }

    protected function configure(): void
    {
        $this->install(new Psr7Module());
        $this->bind()->annotatedWith('slack_signing_secret')->toInstance($this->signingSecret);
        $this->bindInterceptor(
            $this->matcher->subclassesOf(ResourceObject::class),
            $this->matcher->annotatedWith(SlackRequestVerified::class),
            [VerifySlackRequestSignatureInterceptor::class]
        );
    }
}
