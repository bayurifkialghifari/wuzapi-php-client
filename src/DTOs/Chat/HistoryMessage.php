<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

class HistoryMessage
{
    public function __construct(
        public readonly string $chatJid,
        public readonly int $id,
        public readonly string $mediaLink,
        public readonly string $messageId,
        public readonly string $messageType,
        public readonly string $senderJid,
        public readonly string $textContent,
        public readonly string $timestamp,
        public readonly string $userId,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            chatJid: $data['chat_jid'] ?? '',
            id: (int) ($data['id'] ?? 0),
            mediaLink: $data['media_link'] ?? '',
            messageId: $data['message_id'] ?? '',
            messageType: $data['message_type'] ?? '',
            senderJid: $data['sender_jid'] ?? '',
            textContent: $data['text_content'] ?? '',
            timestamp: $data['timestamp'] ?? '',
            userId: $data['user_id'] ?? '',
        );
    }
}
