<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

class ChatButton
{
    public function __construct(
        public readonly string $buttonId,
        public readonly string $displayText,
        public readonly int $type = 1,
    ) {}

    public function toArray(): array
    {
        return [
            'ButtonId' => $this->buttonId,
            'ButtonText' => ['DisplayText' => $this->displayText],
            'Type' => $this->type,
        ];
    }
}
