<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

use Bayurifkialghifari\WuzApi\DTOs\Common\SimpleContextInfo;

class SendStickerRequest
{
    public function __construct(
        public readonly string $phone,
        public readonly string $sticker, // base64 encoded webp
        public readonly ?string $pngThumbnail = null,
        public readonly ?SimpleContextInfo $contextInfo = null,
    ) {}

    public function toArray(): array
    {
        $data = [
            'Phone' => $this->phone,
            'Sticker' => $this->sticker,
        ];

        if ($this->pngThumbnail !== null) {
            $data['PngThumbnail'] = $this->pngThumbnail;
        }

        if ($this->contextInfo !== null) {
            $data['ContextInfo'] = $this->contextInfo->toArray();
        }

        return $data;
    }
}
