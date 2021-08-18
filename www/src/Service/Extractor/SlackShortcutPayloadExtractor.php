<?php

declare(strict_types=1);

namespace Fer\Deli\Service\Extractor;

use GuzzleHttp\Utils;

class SlackShortcutPayloadExtractor implements SlackShortcutPayloadExtractorInterface
{
    /**
     * {@inheritdoc}
     */
    public function extract(string $payload): array
    {
        $data = $this->convertToArray($payload);

        return [
            'callback' => $data['callback_id'],
            'user_id' => $data['user']['id'],
            'username' => $data['user']['username'],
        ];
    }

    private function convertToArray(string $data): array
    {
        return Utils::jsonDecode($data, true);
    }
}
