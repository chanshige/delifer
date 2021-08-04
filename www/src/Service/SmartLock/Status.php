<?php

declare(strict_types=1);

namespace Fer\Deli\Service\SmartLock;

use Fer\Deli\Extend\CandyHouse\Action\Status as StatusAction;
use Fer\Deli\Extend\CandyHouse\Exception\SesameException;

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
            $sesame = ($this->sesame)(new StatusAction($device->uuid()));

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
