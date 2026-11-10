# filesystem-sdk

HTTP-клиент и контракты шины универсального сервиса [Filesystem](../filesystem). Пакет `intellect-web-development/filesystem-sdk`, namespace `IWD\FilesystemSdk\`.

Чеклист подключения продукта: корневой [`../filesystem/INTEGRATION.md`](../filesystem/INTEGRATION.md).

```php
$client = new FilesystemClient($httpClient, baseUrl: 'http://backend-filesystem.localhost', token: $personalJwt);

$meta = $client->upload(name: 'a.png', content: $bytes, mimeType: 'image', mimeSubtype: 'png');
$file = StoredFile::fromSdk($meta);
$bytes = $client->payload($file->id);
```

Сообщения Messenger (публикация в vhost `platform`):

| Класс | `serializedTypeName` | Exchange |
|-------|----------------------|----------|
| `Message\Command\RemoveFilesMessage` | `filesystem.command.removeFiles` | `filesystem.commands` |

Примеры wiring: [`examples/symfony/`](examples/symfony/).

Подключение: vcs-репозиторий в `composer.json` и зависимость `intellect-web-development/filesystem-sdk`. Path-репозиторий и копия в `packages/` не используются. В `symfony-skeleton` пакет по умолчанию не подключён.
