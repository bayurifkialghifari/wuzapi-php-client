<?php

namespace Bayurifkialghifari\WuzApi\DTOs\User;

class UserAvatarResponse
{
    public function __construct(
        public readonly string $url,
        public readonly string $id,
        public readonly string $type,
        public readonly string $directPath,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            url: $data['URL'] ?? '',
            id: $data['ID'] ?? '',
            type: $data['Type'] ?? '',
            directPath: $data['DirectPath'] ?? '',
        );
    }
}
