<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

use Bayurifkialghifari\WuzApi\DTOs\Common\SimpleContextInfo;

class SendLocationRequest
{
    public function __construct(
        public readonly string $phone,
        public readonly float $latitude,
        public readonly float $longitude,
        public readonly ?string $name = null,
        public readonly ?SimpleContextInfo $contextInfo = null,
    ) {}

    public function toArray(): array
    {
        $data = [
            'Phone' => $this->phone,
            'Latitude' => $this->latitude,
            'Longitude' => $this->longitude,
        ];

        if ($this->name !== null) {
            $data['Name'] = $this->name;
        }

        if ($this->contextInfo !== null) {
            $data['ContextInfo'] = $this->contextInfo->toArray();
        }

        return $data;
    }
}
