<?php

declare(strict_types=1);

namespace Juve534\Datadog\Client;

final class ClientFactory
{
    /**
     * HttpOptions.
     *
     * @var array
     */
    private static $httpOptions = [
        'base_uri' => 'https://api.datadoghq.com/',
        'defaults' => [
            'timeout' => 60,
        ],
        'headers' => [
            'Accept' => 'application/json',
        ],
    ];

    public static function create(string $apiToken, array $httpOptions = []): ClientInterface
    {
        $httpOptions = array_merge(self::$httpOptions, $httpOptions);

        return new Client(new \GuzzleHttp\Client($httpOptions), $apiToken);
    }
}
