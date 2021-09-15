<?php

declare(strict_types=1);

namespace Fer\Deli\Service\SmartLock;

use Chanshige\SmartLock\Action\Toggle as ToggleAction;
use Chanshige\SmartLock\Exception\SesameException;
use Koriym\HttpConstants\StatusCode;

use function sprintf;

class Toggle extends AbstractSmartLock
{
    public function run(Actor\Room $room, string $comment): bool
    {
        try {
            $device = $this->resolver->resolve($room->getValue());
            $sesame = ($this->sesame)($device->uuid(), new ToggleAction($device->key(), $comment));

            return $sesame->statusCode() === StatusCode::OK;
        } catch (SesameException $e) {
            $this->logger->error(sprintf(
                'Error occurred during device operation. (code: %s, room: %s)',
                $e->getCode(),
                $room->getName()
            ));

            return false;
        }
    }
}
