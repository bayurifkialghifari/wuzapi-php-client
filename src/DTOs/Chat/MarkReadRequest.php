<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

class MarkReadRequest
{
    /**
     * @param  string[]  $ids
     */
    public function __construct(
        public readonly array $ids,
        public readonly string $chat,
        public readonly ?string $sender = null,
    ) {}

    public function toArray(): array
    {
        $data = [
            'id' => $this->ids,
            'Chat' => $this->chat,
        ];

        if ($this->sender !== null) {
            $data['Sender'] = $this->sender;
        }

        return $data;
    }
}
