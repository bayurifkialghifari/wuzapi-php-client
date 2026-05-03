<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

class DownloadMediaResponse
{
    public function __construct(
        public readonly string $data,
        public readonly string $mimetype,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            data: $data['Data'] ?? '',
            mimetype: $data['Mimetype'] ?? '',
        );
    }
}
