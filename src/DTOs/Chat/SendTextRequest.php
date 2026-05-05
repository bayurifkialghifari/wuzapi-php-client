<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

use Bayurifkialghifari\WuzApi\DTOs\Common\SimpleContextInfo;

class SendTextRequest
{
    public function __construct(
        public readonly string $phone,
        public readonly string $body,
        public readonly ?bool $linkPreview = false,
        public readonly ?string $id = null,
        public readonly ?SimpleContextInfo $contextInfo = null,
    ) {}

    public function toArray(): array
    {
        $data = [
            'Phone' => $this->phone,
            'Body' => $this->body,
            'LinkPreview' => $this->linkPreview,
        ];

        if ($this->id !== null) {
            $data['Id'] = $this->id;
        }

        if ($this->contextInfo !== null) {
            $data['ContextInfo'] = $this->contextInfo->toArray();
        }

        return $data;
    }
}
