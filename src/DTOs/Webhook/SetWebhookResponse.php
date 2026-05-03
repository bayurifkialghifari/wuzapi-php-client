<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Webhook;

class SetWebhookResponse
{
    public function __construct(
        public readonly string $webhookUrl,
        /** @var string[] */
        public readonly array $events,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            webhookUrl: $data['WebhookURL'] ?? '',
            events: (array) ($data['Events'] ?? []),
        );
    }
}
