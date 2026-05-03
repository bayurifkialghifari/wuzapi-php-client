<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Common;

class SimpleContextInfo
{
    public function __construct(
        public readonly string $stanzaId,
        public readonly string $participant,
    ) {}

    public function toArray(): array
    {
        return [
            'StanzaId' => $this->stanzaId,
            'Participant' => $this->participant,
        ];
    }
}
