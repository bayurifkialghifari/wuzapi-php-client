<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Group;

class GroupParticipant
{
    public function __construct(
        public readonly string $jid,
        public readonly string $lid,
        public readonly string $displayName,
        public readonly string $phoneNumber,
        public readonly bool $isAdmin,
        public readonly bool $isSuperAdmin,
        public readonly int $error,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            jid: $data['JID'] ?? '',
            lid: $data['LID'] ?? '',
            displayName: $data['DisplayName'] ?? '',
            phoneNumber: $data['PhoneNumber'] ?? '',
            isAdmin: $data['IsAdmin'] ?? false,
            isSuperAdmin: $data['IsSuperAdmin'] ?? false,
            error: (int) ($data['Error'] ?? 0),
        );
    }
}
