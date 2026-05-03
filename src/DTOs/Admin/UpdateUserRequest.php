<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Admin;

class UpdateUserRequest
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $webhook = null,
        public readonly ?string $events = null,
        public readonly ?int $history = null,
        public readonly ?array $proxyConfig = null,
        public readonly ?array $s3Config = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'webhook' => $this->webhook,
            'events' => $this->events,
            'history' => $this->history,
            'proxyConfig' => $this->proxyConfig,
            's3Config' => $this->s3Config,
        ], fn ($v) => $v !== null);
    }
}
