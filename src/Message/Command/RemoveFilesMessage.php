<?php

declare(strict_types=1);

namespace IWD\FilesystemSdk\Message\Command;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage(
    transport: 'filesystem-transport',
    serializedTypeName: 'filesystem.command.removeFiles',
)]
readonly class RemoveFilesMessage
{
    /**
     * @param list<string> $fileIds               Filesystem.File.id (UUID strings)
     * @param string       $integrationSystemCode Код системы-владельца файлов (APP_SLUG), Filesystem сверяет владельца
     */
    public function __construct(
        public array $fileIds,
        public string $integrationSystemCode,
    ) {
    }
}
