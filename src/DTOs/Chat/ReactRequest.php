<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

class ReactRequest
{
    public function __construct(
        public readonly string $phone,
        public readonly string $body, // emoji
        public readonly string $id,   // message id to react to
    ) {}

    public function toArray(): array
    {
        return [
            'Phone' => $this->phone,
            'Body' => $this->body,
            'Id' => $this->id,
        ];
    }
}
