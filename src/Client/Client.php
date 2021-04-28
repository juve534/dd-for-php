<?php

declare(strict_types=1);

namespace Juve534\Datadog\Client;

use GuzzleHttp\ClientInterface as HttpClientInterface;

class Client implements ClientInterface
{
    /**
     * Client constructor.
     */
    public function __construct(
        private HttpClientInterface $httpClient,
        private string $apiToken,
        private string $appKey
    ) {
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

    /**
     * {@inheritdoc}
     */
    public function get(string $path, array $data = []): array
    {
        $headers = [
            'headers' => [
                'Content-Type'       => 'application/json',
                'DD-API-KEY'         => $this->apiToken,
                'DD-APPLICATION-KEY' => $this->appKey,
            ],
        ];
        $options = array_merge($headers, $data);

        return json_decode($this->httpClient->request('GET', $path, $options)->getBody()->getContents(), true);
    }

    private function request(string $method, string $path, array $options = []): array
    {
        return json_decode($this->httpClient->request($method, $path, $options)->getBody()->getContents(), true);
    }
}
