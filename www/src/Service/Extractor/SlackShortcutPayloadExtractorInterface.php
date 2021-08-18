<?php

declare(strict_types=1);

namespace Fer\Deli\Service\Extractor;

interface SlackShortcutPayloadExtractorInterface
{
    /**
     * @return array<string, mixed>
     */
    public function extract(string $payload): array;
}
