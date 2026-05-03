<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Session;

class ConnectRequest
{
    public function __construct(
        public readonly bool $immediate = false,
    ) {}

    public function toArray(): array
    {
        return [
            'Immediate' => $this->immediate,
        ];
    }
}
