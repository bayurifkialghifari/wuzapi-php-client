<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Common;

class S3Config
{
    public function __construct(
        public readonly bool $enabled,
        public readonly string $endpoint,
        public readonly string $region,
        public readonly string $bucket,
        public readonly string $accessKey,
        public readonly string $secretKey,
        public readonly bool $pathStyle,
        public readonly string $mediaDelivery, // 'base64' | 's3' | 'both'
        public readonly int $retentionDays,
        public readonly ?string $publicUrl = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'enabled' => $this->enabled,
            'endpoint' => $this->endpoint,
            'region' => $this->region,
            'bucket' => $this->bucket,
            'accessKey' => $this->accessKey,
            'secretKey' => $this->secretKey,
            'pathStyle' => $this->pathStyle,
            'mediaDelivery' => $this->mediaDelivery,
            'retentionDays' => $this->retentionDays,
            'publicURL' => $this->publicUrl,
        ], fn ($v) => $v !== null);
    }
}
