<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Common;

class ProxyConfig
{
    public function __construct(
        public readonly bool $enabled,
        public readonly string $proxyUrl,
    ) {}

    public function toArray(): array
    {
        return [
            'enabled' => $this->enabled,
            'proxyURL' => $this->proxyUrl,
        ];
    }
}
