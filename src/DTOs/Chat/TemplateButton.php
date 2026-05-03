<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

class TemplateButton
{
    public function __construct(
        public readonly string $displayText,
        public readonly string $type, // 'quickreply' | 'url' | 'call'
        public readonly ?string $url = null,
        public readonly ?string $phoneNumber = null,
    ) {}

    public function toArray(): array
    {
        return array_filter([
            'DisplayText' => $this->displayText,
            'Type' => $this->type,
            'Url' => $this->url,
            'PhoneNumber' => $this->phoneNumber,
        ], fn ($v) => $v !== null);
    }
}
