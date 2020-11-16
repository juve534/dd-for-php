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

    /**
     * @param $path
     * @param $eventId
     * @param $expected
     *
     * @dataProvider getEventDataProvider
     */
    public function testGetEvent($path, $eventId, $expected)
    {
        $mock = Mockery::mock(ClientInterface::class);
        $mock->shouldReceive('get')
            ->once()
            ->with($path)
            ->andReturn($expected);

        $event = new Event($mock);
        $actual = $event->getEvent($eventId);

        $this->assertEquals($expected, $actual);
    }

    public function getEventDataProvider()
    {
        $eventId = 1;
        $path = sprintf('%s/%d', Event::END_POINT, $eventId);
        $response = [
            'event' => [
                'date_happened' => 1,
                'alert_type'    => 'info',
                'resource'      => '/api/v1/events/1',
                'title'         => 'Datadog agent (v. 7.23.1) started on hoge',
                'url'           => '/event/event?id=1',
                'text'          => 'hoge',
                'tags'          => [
                    'environment' => 'test',
                ],
                'id'            => 1,
                'priority'      => 'normal',
                'host'          => 'hoge',
                'device_name'   => null,
                'payload'       => '"{"hosts": ["hoge"]}',
            ],
        ];

        return [
            'success event' => [
                'path'     => $path,
                'eventId'  => $eventId,
                'response' => $response,
            ],
        ];
    }
}
