<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Webhook;

class UpdateWebhookRequest
{
    /**
     * @param  string[]|WebhookEventType[]|null  $events
     */
    public function __construct(
        public readonly ?string $webhook = null,
        public readonly ?array $events = null,
        public readonly ?bool $active = null,
    ) {}

    public function toArray(): array
    {
        $data = [];

        if ($this->webhook !== null) {
            $data['webhook'] = $this->webhook;
        }

        if ($this->events !== null) {
            $data['events'] = array_map(
                fn ($e) => $e instanceof WebhookEventType ? $e->value : $e,
                $this->events
            );
        }

        if ($this->active !== null) {
            $data['Active'] = $this->active;
        }

        return $data;
    }
}
