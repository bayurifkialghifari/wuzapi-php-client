<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

use Bayurifkialghifari\WuzApi\DTOs\Common\SimpleContextInfo;

class SendAudioRequest
{
    public function __construct(
        public readonly string $phone,
        public readonly string $audio, // base64 encoded
        public readonly ?SimpleContextInfo $contextInfo = null,
    ) {}

    public function toArray(): array
    {
        $data = [
            'Phone' => $this->phone,
            'Audio' => $this->audio,
        ];

        if ($this->contextInfo !== null) {
            $data['ContextInfo'] = $this->contextInfo->toArray();
        }

        return $data;
    }
}
