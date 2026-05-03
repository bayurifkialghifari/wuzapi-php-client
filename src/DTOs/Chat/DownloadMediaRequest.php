<?php

namespace Bayurifkialghifari\WuzApi\DTOs\Chat;

class DownloadMediaRequest
{
    public function __construct(
        public readonly string $url,
        public readonly string $directPath,
        public readonly string $mediaKey,
        public readonly string $mimetype,
        public readonly string $fileEncSha256,
        public readonly string $fileSha256,
        public readonly int $fileLength,
    ) {}

    public function toArray(): array
    {
        return [
            'Url' => $this->url,
            'DirectPath' => $this->directPath,
            'MediaKey' => $this->mediaKey,
            'Mimetype' => $this->mimetype,
            'FileEncSHA256' => $this->fileEncSha256,
            'FileSHA256' => $this->fileSha256,
            'FileLength' => $this->fileLength,
        ];
    }
}
