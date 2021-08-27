<?php

declare(strict_types=1);

namespace Fer\Deli\Service\SmartLock;

use Chanshige\SmartLock\Contracts\SesameInterface;
use Psr\Log\LoggerInterface;

abstract class AbstractSmartLock
{
    public function __construct(
        protected SesameInterface $sesame,
        protected LoggerInterface $logger,
        protected DeviceResolverInterface $resolver,
    ) {
    }
}
