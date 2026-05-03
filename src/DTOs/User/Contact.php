<?php

namespace Bayurifkialghifari\WuzApi\DTOs\User;

class Contact
{
    public function __construct(
        public readonly string $businessName,
        public readonly string $firstName,
        public readonly bool $found,
        public readonly string $fullName,
        public readonly string $pushName,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            businessName: $data['BusinessName'] ?? '',
            firstName: $data['FirstName'] ?? '',
            found: $data['Found'] ?? false,
            fullName: $data['FullName'] ?? '',
            pushName: $data['PushName'] ?? '',
        );
    }
}
