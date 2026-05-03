<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

use Bayurifkialghifari\WuzApi\DTOs\Common\SimpleContextInfo;

class SendContactRequest
{
    public function __construct(
        public readonly string $phone,
        public readonly string $name,
        public readonly string $vcard,
        public readonly ?SimpleContextInfo $contextInfo = null,
    ) {}

    public function toArray(): array
    {
        $data = [
            'Phone' => $this->phone,
            'Name' => $this->name,
            'Vcard' => $this->vcard,
        ];

        if ($this->contextInfo !== null) {
            $data['ContextInfo'] = $this->contextInfo->toArray();
        }

        return $data;
    }
}
