<?php

declare(strict_types=1);

namespace Fer\Deli\Service\SmartLock;

use Chanshige\SmartLock\Action\Lock as LockAction;
use Chanshige\SmartLock\Exception\SesameException;
use Koriym\HttpConstants\StatusCode;

use function sprintf;

class Lock extends AbstractSmartLock
{
    public function run(Actor\Room $room, string $comment): bool
    {
        try {
            $device = $this->resolver->resolve($room->getValue());
            $sesame = ($this->sesame)($device->uuid(), new LockAction($device->key(), $comment));

            return $sesame->statusCode() === StatusCode::OK;
        } catch (SesameException $e) {
            $this->logger->error(sprintf(
                'Error occurred while locking the device.(code: %s, room: %s)',
                $e->getCode(),
                $room->getName()
            ));

            return false;
        }
    }
}
