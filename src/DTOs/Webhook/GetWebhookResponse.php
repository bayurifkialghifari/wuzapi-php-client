<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Webhook;

class GetWebhookResponse
{
    public function __construct(
        /** @var string[] */
        public readonly array $subscribe,
        public readonly string $webhook,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            subscribe: (array) ($data['subscribe'] ?? []),
            webhook: $data['webhook'] ?? '',
        );
    }
}
