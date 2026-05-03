<?php

namespace Bayurifkialghifari\WuzApi\DTOs\User;

class UserCheck
{
    public function __construct(
        public readonly bool $isInWhatsapp,
        public readonly string $jid,
        public readonly string $query,
        public readonly string $verifiedName,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            isInWhatsapp: $data['IsInWhatsapp'] ?? false,
            jid: $data['JID'] ?? '',
            query: $data['Query'] ?? '',
            verifiedName: $data['VerifiedName'] ?? '',
        );
    }
}
