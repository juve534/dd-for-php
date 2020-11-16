<?php

declare(strict_types=1);

namespace juve534\Datadog\Api;

use Juve534\Datadog\Client\ClientInterface;

class Event
{
    const END_POINT = 'api/v1/events';

    private ClientInterface $client;

    /**
     * Event constructor.
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $text    Event text
     * @param string $title   Event title
     * @param array  $options optional params
     */
    public function putEvent(string $text, string $title, array $options = []): void
    {
        $this->client->post(self::END_POINT, [
            'text'  => $text,
            'title' => $title,
            $options,
        ]);
    }

    /**
     * @param int $eventId event Id
     *
     * @return array api response
     */
    public function getEvent(int $eventId): array
    {
        $path = sprintf('%s/%d', self::END_POINT, $eventId);

        return $this->client->get($path);
    }
}
