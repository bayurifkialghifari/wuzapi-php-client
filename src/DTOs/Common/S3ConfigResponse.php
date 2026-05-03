<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Common;

class S3ConfigResponse
{
    public function __construct(
        public readonly string $accessKey,
        public readonly string $bucket,
        public readonly bool $enabled,
        public readonly string $endpoint,
        public readonly ?string $mediaDelivery = null,
        public readonly ?bool $pathStyle = null,
        public readonly ?string $publicUrl = null,
        public readonly ?string $region = null,
        public readonly ?int $retentionDays = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            accessKey: $data['access_key'] ?? '',
            bucket: $data['bucket'] ?? '',
            enabled: $data['enabled'] ?? false,
            endpoint: $data['endpoint'] ?? '',
            mediaDelivery: $data['media_delivery'] ?? null,
            pathStyle: $data['path_style'] ?? null,
            publicUrl: $data['public_url'] ?? null,
            region: $data['region'] ?? null,
            retentionDays: $data['retention_days'] ?? null,
        );
    }
}
