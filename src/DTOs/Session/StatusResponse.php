<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Session;

class StatusResponse
{
    public function __construct(
        public readonly bool $connected,
        public readonly array $events,
        public readonly string $id,
        public readonly string $jid,
        public readonly bool $loggedIn,
        public readonly string $name,
        public readonly array $proxyConfig,
        public readonly string $proxyUrl,
        public readonly string $qrcode,
        public readonly array $s3Config,
        public readonly string $token,
        public readonly string $webhook,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            connected: $data['connected'] ?? false,
            events: (array) ($data['events'] ?? []),
            id: $data['id'] ?? '',
            jid: $data['jid'] ?? '',
            loggedIn: $data['loggedIn'] ?? false,
            name: $data['name'] ?? '',
            proxyConfig: (array) ($data['proxy_config'] ?? []),
            proxyUrl: $data['proxy_url'] ?? '',
            qrcode: $data['qrcode'] ?? '',
            s3Config: (array) ($data['s3_config'] ?? []),
            token: $data['token'] ?? '',
            webhook: $data['webhook'] ?? '',
        );
    }
}
