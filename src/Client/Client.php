<?php

declare(strict_types=1);

namespace Juve534\Datadog\Client;

use GuzzleHttp\ClientInterface as HttpClientInterface;

class Client implements ClientInterface
{
    private HttpClientInterface $httpClient;

    /**
     * Datadog Api Token.
     */
    private string $apiToken;

    /**
     * Datadog App Key.
     */
    private string $appKey;

    /**
     * Client constructor.
     */
    public function __construct(HttpClientInterface $httpClient, string $apiToken, string $appKey)
    {
        $this->httpClient = $httpClient;
        $this->apiToken = $apiToken;
        $this->appKey = $appKey;
    }

    /**
     * {@inheritdoc}
     */
    public function post(string $path, array $data = []): array
    {
        $options = [
            'query' => [
                'api_key' => $this->apiToken,
            ],
            'json' => $data,
        ];

        return $this->request('POST', $path, $options);
    }

    private function request(string $method, string $path, array $options = []): array
    {
        return json_decode($this->httpClient->request($method, $path, $options)->getBody()->getContents(), true);
    }
}
