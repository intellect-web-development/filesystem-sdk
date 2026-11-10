<?php

declare(strict_types=1);

namespace IWD\FilesystemSdk;

/** Метаданные файла из ответа upload/read SDK (без payload). */
final readonly class StoredFile
{
    public function __construct(
        public string $id,
        public string $uuid,
        public string $name,
        public int $size,
        public string $mimeType,
        public string $mimeSubtype,
        public ?string $extension = null,
        public ?string $createdAt = null,
    ) {
    }

    /**
     * @param array{
     *     id: string,
     *     uuid: string,
     *     size: int,
     *     name: string,
     *     mimeType: string,
     *     mimeSubtype: string,
     *     extension?: string|null,
     *     createdAt?: string|null
     * } $row
     */
    public static function fromSdk(array $row): self
    {
        return new self(
            id: $row['id'],
            uuid: $row['uuid'],
            name: $row['name'],
            size: $row['size'],
            mimeType: $row['mimeType'],
            mimeSubtype: $row['mimeSubtype'],
            extension: $row['extension'] ?? null,
            createdAt: $row['createdAt'] ?? null,
        );
    }
}
