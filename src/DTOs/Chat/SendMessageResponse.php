<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

class SendMessageResponse
{
    public function __construct(
        public readonly string $details,
        public readonly string $id,
        public readonly string $timestamp,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            details: $data['Details'] ?? '',
            id: $data['Id'] ?? '',
            timestamp: $data['Timestamp'] ?? '',
        );
    }
}
