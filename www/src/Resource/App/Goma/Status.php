<?php

declare(strict_types=1);

namespace Fer\Deli\Resource\App\Goma;

use BEAR\RepositoryModule\Annotation\Cacheable;
use BEAR\Resource\ResourceObject;
use Fer\Deli\UseCase\GetInformationSesameDevices;

#[Cacheable(expirySecond: 15)]
class Status extends ResourceObject
{
    public function __construct(
        private GetInformationSesameDevices $devices
    ) {
    }

    public function onGet(): static
    {
        $this->body = $this->devices->get();

        return $this;
    }
}
