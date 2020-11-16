<?php

declare(strict_types=1);

namespace Tests\Api;

use Juve534\Datadog\Api\Event;
use Juve534\Datadog\Client\ClientInterface;
use Mockery;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    /**
     * @param $text
     * @param $title
     * @param $options
     *
     * @dataProvider putEventDataProvider
     */
    public function testPutEvent($text, $title, $options)
    {
        $mock = Mockery::mock(ClientInterface::class);
        $mock->shouldReceive('post')
            ->once()
            ->with(Event::END_POINT, [
                'text'  => $text,
                'title' => $title,
                $options,
            ])
            ->andReturn([]);

        $event = new Event($mock);
        $event->putEvent($text, $title, $options);

        $this->assertTrue(true);
    }

    public function putEventDataProvider()
    {
        $title = 'hoge';
        $text = 'hoge';
        $options = [
            'tags' => [
                'environment' => 'test',
            ],
        ];

        return [
            'success event' => [
                'text'    => $text,
                'title'   => $title,
                'options' => $options,
            ],
        ];
    }
}
