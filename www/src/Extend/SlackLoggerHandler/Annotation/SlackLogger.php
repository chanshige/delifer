<?php

declare(strict_types=1);

namespace Fer\Deli\Extend\SlackLoggerHandler\Annotation;

use Attribute;
use Ray\Di\Di\Qualifier;

#[Attribute(Attribute::TARGET_PARAMETER | Attribute::TARGET_PROPERTY | Attribute::TARGET_METHOD), Qualifier]
final class SlackLogger
{
}
