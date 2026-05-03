<?php

namespace Bayurifkialghifari\WuzApi\DTOs\User;

class UserLidResponse
{
    public function __construct(
        public readonly string $lid,
        public readonly string $phone,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            lid: $data['LID'] ?? '',
            phone: $data['Phone'] ?? '',
        );
    }
}
