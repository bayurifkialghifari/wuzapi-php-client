<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

use Bayurifkialghifari\WuzApi\DTOs\Common\SimpleContextInfo;

class SendButtonsRequest
{
    /**
     * @param  ChatButton[]  $buttons
     */
    public function __construct(
        public readonly string $phone,
        public readonly string $body,
        public readonly array $buttons,
        public readonly ?string $footer = null,
        public readonly ?SimpleContextInfo $contextInfo = null,
    ) {}

    public function toArray(): array
    {
        $data = [
            'Phone' => $this->phone,
            'Body' => $this->body,
            'Buttons' => array_map(fn (ChatButton $b) => $b->toArray(), $this->buttons),
        ];

        if ($this->footer !== null) {
            $data['Footer'] = $this->footer;
        }

        if ($this->contextInfo !== null) {
            $data['ContextInfo'] = $this->contextInfo->toArray();
        }

        return $data;
    }
}
