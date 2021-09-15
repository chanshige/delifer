<?php

declare(strict_types=1);

namespace Fer\Deli\Service\SmartLock;

use Chanshige\SmartLock\Action\Status as StatusAction;
use Chanshige\SmartLock\Exception\SesameException;

use function sprintf;

class Status extends AbstractSmartLock
{
    /**
     * @return array<string, mixed>
     */
    public function run(Actor\Room $room): array
    {
        try {
            $device = $this->resolver->resolve($room->getValue());
            $sesame = ($this->sesame)($device->uuid(), new StatusAction());

            return $sesame->toArray();
        } catch (SesameException $e) {
            $this->logger->error(sprintf(
                'Error occurred while getting device information. (code: %s, room: %s)',
                $e->getCode(),
                $room->getName()
            ));

            return [];
        }
    }
}
