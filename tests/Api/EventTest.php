<?php

declare(strict_types=1);

namespace Tests\Api;

use Juve534\Datadog\Api\Event;
use Juve534\Datadog\Client\ClientInterface;
use Mockery;
use PHPUnit\Framework\TestCase;

class EventTest extends TestCase
{
    public function testPutEvent()
    {
        $mock = Mockery::mock(ClientInterface::class);
        $mock->shouldReceive('post')
            ->once()
            ->with(Event::END_POINT, [
                'text'  => 'hoge',
                'title' => 'hoge',
            ])
            ->andReturn([]);

        $event = new Event($mock);
        $event->putEvent('hoge', 'hoge');

        $this->assertTrue(true);
    }
}
