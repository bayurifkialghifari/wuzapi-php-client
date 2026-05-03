<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

use Bayurifkialghifari\WuzApi\DTOs\Common\SimpleContextInfo;

class SendImageRequest
{
    public function __construct(
        public readonly string $phone,
        public readonly string $image, // base64 encoded
        public readonly ?string $caption = null,
        public readonly ?SimpleContextInfo $contextInfo = null,
    ) {}

    public function toArray(): array
    {
        $data = [
            'Phone' => $this->phone,
            'Image' => $this->image,
        ];

        if ($this->caption !== null) {
            $data['Caption'] = $this->caption;
        }

        if ($this->contextInfo !== null) {
            $data['ContextInfo'] = $this->contextInfo->toArray();
        }

        return $data;
    }
}
