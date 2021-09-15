<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\VerifySlackRequestSignature\Exception;

use LogicException;
use Throwable;

class VerifySlackRequestSignatureException extends LogicException implements Throwable
{
}
