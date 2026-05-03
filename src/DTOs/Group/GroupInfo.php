<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Group;

class GroupInfo
{
    /**
     * @param  GroupParticipant[]  $participants
     */
    public function __construct(
        public readonly string $jid,
        public readonly string $name,
        public readonly string $ownerJid,
        public readonly string $topic,
        public readonly string $groupCreated,
        public readonly bool $isAnnounce,
        public readonly bool $isLocked,
        public readonly bool $isEphemeral,
        public readonly array $participants,
        public readonly string $addressingMode = '',
        public readonly string $memberAddMode = '',
        public readonly int $disappearingTimer = 0,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            jid: $data['JID'] ?? '',
            name: $data['Name'] ?? '',
            ownerJid: $data['OwnerJID'] ?? '',
            topic: $data['Topic'] ?? '',
            groupCreated: $data['GroupCreated'] ?? '',
            isAnnounce: $data['IsAnnounce'] ?? false,
            isLocked: $data['IsLocked'] ?? false,
            isEphemeral: $data['IsEphemeral'] ?? false,
            participants: array_map(
                fn (array $p) => GroupParticipant::fromArray($p),
                $data['Participants'] ?? []
            ),
            addressingMode: $data['AddressingMode'] ?? '',
            memberAddMode: $data['MemberAddMode'] ?? '',
            disappearingTimer: (int) ($data['DisappearingTimer'] ?? 0),
        );
    }
}
