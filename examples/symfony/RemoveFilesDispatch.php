<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Doctrine\Filesystem;

use IWD\FilesystemSdk\Message\Command\RemoveFilesMessage;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Пример: после flush удалить файлы в Filesystem асинхронно.
 * Скопировать/адаптировать в продукт при opt-in.
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
