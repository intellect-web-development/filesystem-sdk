<?php

declare(strict_types=1);

namespace IWD\FilesystemSdk;

use Symfony\Contracts\HttpClient\HttpClientInterface;

final readonly class FilesystemClient
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private string $baseUrl,
        private string $token,
        private string $integrationSystemCode,
    ) {
    }

    /**
     * @return array{id: string, uuid: string, size: int, name: string, mimeType: string, mimeSubtype: string}
     */
    public function upload(
        string $name,
        string $content,
        string $mimeType,
        string $mimeSubtype,
        ?string $extension = null,
    ): array {
        $response = $this->httpClient->request('POST', $this->url('/api/sdk/files'), [
            'headers' => $this->headers(),
            'json' => [
                'name' => $name,
                'contentBase64' => base64_encode($content),
                'mimeType' => $mimeType,
                'mimeSubtype' => $mimeSubtype,
                'extension' => $extension,
            ],
        ]);
        /** @var array{id: string, uuid: string, size: int, name: string, mimeType: string, mimeSubtype: string} $data */
        $data = $response->toArray();

        return $data;
    }

    /**
     * @return array{id: string, uuid: string, size: int, name: string, mimeType: string, mimeSubtype: string}
     */
    public function read(string $id): array
    {
        $response = $this->httpClient->request('GET', $this->url('/api/sdk/files/' . $id), [
            'headers' => $this->headers(),
        ]);
        /** @var array{id: string, uuid: string, size: int, name: string, mimeType: string, mimeSubtype: string} $data */
        $data = $response->toArray();

        return $data;
    }

    public function payload(string $id): string
    {
        $response = $this->httpClient->request('GET', $this->url('/api/sdk/files/' . $id . '/payload'), [
            'headers' => $this->headers(),
        ]);

        return $response->getContent();
    }

    /** @return array<string, string> */
    private function headers(): array
    {
        return [
            'X-Platform-Token' => $this->token,
            'X-Integration-System-Code' => $this->integrationSystemCode,
        ];
    }

    private function url(string $path): string
    {
        return rtrim($this->baseUrl, '/') . $path;
    }
}
