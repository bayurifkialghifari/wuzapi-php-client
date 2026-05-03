<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Session;

class ConnectResponse
{
    public function __construct(
        public readonly string $details,
        public readonly string $events,
        public readonly string $jid,
        public readonly string $webhook,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            details: $data['details'] ?? '',
            events: $data['events'] ?? '',
            jid: $data['jid'] ?? '',
            webhook: $data['webhook'] ?? '',
        );
    }
}
