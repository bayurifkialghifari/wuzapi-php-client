<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Session;

class QRCodeResponse
{
    public function __construct(
        public readonly string $qrCode,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(qrCode: $data['QRCode'] ?? '');
    }
}
