<?php

declare(strict_types=1);

namespace Fer\Deli\Service\SmartLock;

use Fer\Deli\Service\SmartLock\Device\DeviceInterface;
use Ray\Di\Di\Named;
use RuntimeException;

use function sprintf;

class DeviceResolver implements DeviceResolverInterface
{
    /** @var array<string, int> */
    private array $deviceByName = [];

    /**
     * @param array<int, DeviceInterface> $devices
     */
    #[Named('sesame_devices')]
    public function __construct(
        private array $devices
    ) {
    }

    public function resolve(string $name): DeviceInterface
    {
        if (
            isset($this->deviceByName[$name])
            && isset($this->devices[$this->deviceByName[$name]])
        ) {
            return $this->devices[$this->deviceByName[$name]];
        }

        foreach ($this->devices as $i => $extractor) {
            if ($extractor->supports($name)) {
                $this->deviceByName[$name] = $i;

                return $extractor;
            }
        }

        throw new RuntimeException(sprintf('No device found for "%s".', $name));
    }
}
