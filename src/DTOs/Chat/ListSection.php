<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

class ListSection
{
    /**
     * @param  ListItem[]  $rows
     */
    public function __construct(
        public readonly string $title,
        public readonly array $rows,
    ) {}

    public function toArray(): array
    {
        return [
            'Title' => $this->title,
            'Rows' => array_map(fn (ListItem $item) => $item->toArray(), $this->rows),
        ];
    }
}
