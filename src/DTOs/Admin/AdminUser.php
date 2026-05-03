<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Admin;

class AdminUser
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $token,
        public readonly bool $connected,
        public readonly bool $loggedIn,
        public readonly string $jid,
        public readonly string $webhook,
        public readonly string|array $events,
        public readonly int $expiration,
        public readonly string $qrcode,
        public readonly array $proxyConfig,
        public readonly array $s3Config,
        public readonly int $history,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? '',
            name: $data['name'] ?? '',
            token: $data['token'] ?? '',
            connected: $data['connected'] ?? false,
            loggedIn: $data['loggedIn'] ?? false,
            jid: $data['jid'] ?? '',
            webhook: $data['webhook'] ?? '',
            events: $data['events'] ?? [],
            expiration: (int) ($data['expiration'] ?? 0),
            qrcode: $data['qrcode'] ?? '',
            proxyConfig: (array) ($data['proxy_config'] ?? []),
            s3Config: (array) ($data['s3_config'] ?? []),
            history: (int) ($data['history'] ?? 0),
        );
    }
}
