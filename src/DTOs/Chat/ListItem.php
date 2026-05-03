<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

class ListItem
{
    public function __construct(
        public readonly string $title,
        public readonly string $rowId,
        public readonly ?string $desc = null,
    ) {}

    public function toArray(): array
    {
        $data = [
            'Title' => $this->title,
            'RowId' => $this->rowId,
        ];

        if ($this->desc !== null) {
            $data['Desc'] = $this->desc;
        }

        return $data;
    }
}
