<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

use Bayurifkialghifari\WuzApi\DTOs\Common\SimpleContextInfo;

class SendVideoRequest
{
    public function __construct(
        public readonly string $phone,
        public readonly string $video, // base64 encoded
        public readonly ?string $caption = null,
        public readonly ?string $jpegThumbnail = null,
        public readonly ?SimpleContextInfo $contextInfo = null,
    ) {}

    public function toArray(): array
    {
        $data = [
            'Phone' => $this->phone,
            'Video' => $this->video,
        ];

        if ($this->caption !== null) {
            $data['Caption'] = $this->caption;
        }

        if ($this->jpegThumbnail !== null) {
            $data['JpegThumbnail'] = $this->jpegThumbnail;
        }

        if ($this->contextInfo !== null) {
            $data['ContextInfo'] = $this->contextInfo->toArray();
        }

        return $data;
    }
}
