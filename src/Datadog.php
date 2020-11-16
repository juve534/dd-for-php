<?php

declare(strict_types=1);

namespace juve534\Datadog;

use Juve534\Datadog\Api\Event;
use Juve534\Datadog\Client\ClientFactory;
use Juve534\Datadog\Client\ClientInterface;

class Datadog
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function event(): Event
    {
        return new Event($this->client);
    }

    public static function create(string $token, array $httpOptions = []): self
    {
        return new self(ClientFactory::create($token, $httpOptions));
    }
}
