<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\CandyHouse\Action;

use Fer\Deli\Extend\CandyHouse\Contracts\CommandActionInterface;
use Fer\Deli\Extend\CandyHouse\Extend\AesCmac;
use Fer\Deli\Extend\CandyHouse\Extend\Timestamp;
use Fer\Deli\Extend\CandyHouse\Extend\UInt32LE;

use function base64_encode;
use function bin2hex;
use function sprintf;
use function substr;

final class Command extends AbstractAction implements CommandActionInterface
{
    protected string $history;
    protected string $sign;

    public function __construct(
        protected int $cmd,
        private string $uuid,
        string $key,
    ) {
        $this->sign = $this->generateSignature($key);
    }

    public function method(): string
    {
        return self::POST;
    }

    public function history(string $note): CommandActionInterface
    {
        $this->history = base64_encode($note);

        return $this;
    }

    public function __toString(): string
    {
        return sprintf('/sesame2/%s/cmd', $this->uuid);
    }

    private function generateSignature(string $secretKeyHex): string
    {
        return AesCmac::hexdigest($secretKeyHex, substr(bin2hex(UInt32LE::pack(Timestamp::now())), 2, 8));
    }
}
