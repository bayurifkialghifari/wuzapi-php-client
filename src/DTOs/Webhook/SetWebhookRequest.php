<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Webhook;

class SetWebhookRequest
{
    /**
     * @param  string[]|WebhookEventType[]  $events
     */
    public function __construct(
        public readonly string $webhook,
        public readonly array $events = ['All'],
    ) {}

    public function toArray(): array
    {
        return [
            'WebhookURL' => $this->webhook,
            'Events' => array_map(
                fn ($e) => $e instanceof WebhookEventType ? $e->value : $e,
                $this->events
            ),
        ];
    }
}
