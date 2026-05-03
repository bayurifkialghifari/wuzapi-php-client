<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Admin;

class CreateUserRequest
{
    public function __construct(
        public readonly string $name,
        public readonly string $token,
        public readonly ?string $webhook = null,
        public readonly ?string $events = 'All',
        public readonly ?int $history = 0,
        public readonly ?array $proxyConfig = null,
        public readonly ?array $s3Config = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'token' => $this->token,
            'webhook' => $this->webhook,
            'events' => $this->events,
            'history' => $this->history,
            'proxyConfig' => $this->proxyConfig,
            's3Config' => $this->s3Config,
        ], fn ($v) => $v !== null);
    }
}
