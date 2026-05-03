<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Session;

class HmacConfigResponse
{
    public function __construct(
        public readonly string $details,
        public readonly ?bool $configured = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            details: $data['Details'] ?? '',
            configured: $data['configured'] ?? null,
        );
    }
}
