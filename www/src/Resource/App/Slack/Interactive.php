<?php

declare(strict_types=1);

namespace Fer\Deli\Resource\App\Slack;

use BEAR\Resource\ResourceObject;
use Fer\Deli\Extend\Console\Argument;
use Fer\Deli\Extend\Console\Definition;
use Fer\Deli\Extend\Console\Input;
use Fer\Deli\Service\Extractor\SlackShortcutPayloadExtractorInterface;
use Psr\Log\LoggerInterface;

class Interactive extends ResourceObject
{
    public function __construct(
        private SlackShortcutPayloadExtractorInterface $extractor,
    ) {
    }

    public function onPost(string $payload): void
    {
        $request = $this->extractor->extract($payload);

        $define = (new Definition())
            ->setArgument('action', Argument::REQUIRED)
            ->setArgument('ext');

        $input = (new Input($request['callback'], $define))->parse('_');

        $input->getArgument('action'); // sesame_unlock, sesame_lock

        // TODO: SlackInteractiveShortcutResolver をつくって、動きをいれる
    }
}
