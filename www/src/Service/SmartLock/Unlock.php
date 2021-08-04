<?php

declare(strict_types=1);

namespace Fer\Deli\Service\SmartLock;

use Fer\Deli\Extend\CandyHouse\Action\Command;
use Fer\Deli\Extend\CandyHouse\Contracts\CommandActionInterface;
use Fer\Deli\Extend\CandyHouse\Exception\SesameException;
use Koriym\HttpConstants\StatusCode;

use function sprintf;

class Unlock extends AbstractSmartLock
{
    public function run(Actor\Room $room, string $comment): bool
    {
        try {
            $device = $this->resolver->resolve($room->getValue());

            $command = new Command(CommandActionInterface::UNLOCK, $device->uuid(), $device->key());
            $command->history($comment);

            $sesame = ($this->sesame)($command);

            return $sesame->statusCode() === StatusCode::OK;
        } catch (SesameException $e) {
            $this->logger->error(sprintf(
                'Error occurred while unlocking the device.(code: %s, room: %s)',
                $e->getCode(),
                $room->getName()
            ));

            return false;
        }
    }
}
