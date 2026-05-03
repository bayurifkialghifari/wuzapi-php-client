<?php

namespace Bayurifkialghifari\WuzApi\DTOs\User;

class UserInfo
{
    /**
     * @param  string[]  $devices
     */
    public function __construct(
        public readonly array $devices,
        public readonly string $pictureId,
        public readonly string $status,
        public readonly ?array $verifiedName = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            devices: (array) ($data['Devices'] ?? []),
            pictureId: $data['PictureID'] ?? '',
            status: $data['Status'] ?? '',
            verifiedName: $data['VerifiedName'] ?? null,
        );
    }
}
