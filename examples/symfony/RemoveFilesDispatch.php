<?php

declare(strict_types=1);

namespace IWD\FilesystemSdk\Examples\Symfony;

use IWD\FilesystemSdk\Message\Command\RemoveFilesMessage;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Пример: после flush удалить файлы в Filesystem асинхронно.
 * В продукте копируйте в App\PlatformProjection\Filesystem (или свой BC) при opt-in.
 */
final readonly class RemoveFilesDispatch
{
    public function __construct(
        private MessageBusInterface $bus,
        private string $integrationSystemCode,
    ) {
    }

    /** @param list<string> $fileIds */
    public function dispatch(array $fileIds): void
    {
        if ([] === $fileIds) {
            return;
        }

        $this->bus->dispatch(new RemoveFilesMessage(
            fileIds: $fileIds,
            integrationSystemCode: $this->integrationSystemCode,
        ));
    }
}
