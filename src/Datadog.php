<?php

declare(strict_types=1);

namespace juve534\Datadog;

use Juve534\Datadog\Api\Event;
use Juve534\Datadog\Client\ClientFactory;
use Juve534\Datadog\Client\ClientInterface;

class Datadog
{
    public function __construct(
        private ClientInterface $client
    ) {
    }

    public function event(): Event
    {
        return new Event($this->client);
    }

    /**
     * @param string $token  Datadog Api Token
     * @param string $appKey Datadog Application Key
     *
     * @return static
     */
    public static function create(string $token, string $appKey, array $httpOptions = []): self
    {
        return new self(ClientFactory::create($token, $appKey, $httpOptions));
    }
}
