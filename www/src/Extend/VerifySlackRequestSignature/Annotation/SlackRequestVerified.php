<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\VerifySlackRequestSignature\Annotation;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
final class SlackRequestVerified
{
}
