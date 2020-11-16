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
     * Client constructor.
     */
    public function __construct(HttpClientInterface $httpClient, string $apiToken)
    {
        $this->httpClient = $httpClient;
        $this->apiToken = $apiToken;
    }

    /**
     * {@inheritdoc}
     */
    public function post(string $path, array $data = []): array
    {
        return $this->request('POST', $path, [
            'json' => $data,
        ]);
    }

    private function request(string $method, string $path, array $options = []): array
    {
        $query = [
            'query' => [
                'api_key' => $this->apiToken,
            ],
        ];

        return json_decode($this->httpClient->request($method, $path, array_merge($query, $options))->getBody()->getContents(), true);
    }
}
