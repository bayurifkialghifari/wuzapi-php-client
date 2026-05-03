<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

class SendListRequest
{
    /**
     * @param  ListSection[]  $sections
     */
    public function __construct(
        public readonly string $phone,
        public readonly string $buttonText,
        public readonly string $desc,
        public readonly string $topText,
        public readonly array $sections = [],
        public readonly ?string $footerText = null,
        public readonly ?string $id = null,
    ) {}

    public function toArray(): array
    {
        $data = [
            'Phone' => $this->phone,
            'ButtonText' => $this->buttonText,
            'Desc' => $this->desc,
            'TopText' => $this->topText,
            'Sections' => array_map(fn (ListSection $s) => $s->toArray(), $this->sections),
        ];

        if ($this->footerText !== null) {
            $data['FooterText'] = $this->footerText;
        }

        if ($this->id !== null) {
            $data['Id'] = $this->id;
        }

        return $data;
    }
}
