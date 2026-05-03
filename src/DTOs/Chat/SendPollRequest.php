<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

class SendPollRequest
{
    /**
     * @param  string[]  $options
     */
    public function __construct(
        public readonly string $group,
        public readonly string $header,
        public readonly array $options,
        public readonly ?string $id = null,
    ) {}

    public function toArray(): array
    {
        $data = [
            'Group' => $this->group,
            'Header' => $this->header,
            'Options' => $this->options,
        ];

        if ($this->id !== null) {
            $data['Id'] = $this->id;
        }

        return $data;
    }
}
