<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Session;

class PairPhoneResponse
{
    public function __construct(
        public readonly string $linkingCode,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(linkingCode: $data['LinkingCode'] ?? '');
    }
}
