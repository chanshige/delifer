<?php

declare(strict_types=1);

namespace Fer\Deli\Service\Extractor\Module;

use Fer\Deli\Service\Extractor\SlackShortcutPayloadExtractor;
use Fer\Deli\Service\Extractor\SlackShortcutPayloadExtractorInterface;
use Ray\Di\AbstractModule;
use Ray\Di\Scope;

class ExtractorServiceModule extends AbstractModule
{
    protected function configure(): void
    {
        $this->bind(SlackShortcutPayloadExtractorInterface::class)
            ->to(SlackShortcutPayloadExtractor::class)
            ->in(Scope::SINGLETON);
    }
}
