<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Group;

class ParticipantUpdate
{
    public function __construct(
        public readonly string $jid,
        public readonly string $status,
        public readonly int $code,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            jid: $data['JID'] ?? '',
            status: $data['Status'] ?? '',
            code: (int) ($data['Code'] ?? 0),
        );
    }
}
