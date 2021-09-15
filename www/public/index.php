<?php

declare(strict_types=1);

use Fer\Deli\Bootstrap;

require dirname(__DIR__) . '/autoload.php';
exit((new Bootstrap())(PHP_SAPI === 'cli-server' ? 'api-app' : 'prod-api-app', $GLOBALS, $_SERVER));
